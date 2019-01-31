<?php
/**
 * @package    opening-hours
 *
 * @author     Christian Friedemann <c.friedemann@pixelstun.de>
 * @copyright  2019 pixelstun.de
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://pixelstun.de
 */

defined( '_JEXEC' ) or die;

// Access to module parameters
$monday    = $params->get( 'monday', '' );
$tuesday   = $params->get( 'tuesday', '' );
$wednesday = $params->get( 'wednesday', '' );
$thursday  = $params->get( 'thursday', '' );
$friday    = $params->get( 'friday', '' );
$saturday  = $params->get( 'saturday', '' );
$sunday    = $params->get( 'sunday', '' );

$group = $params->get( 'group_days', 1 );

$groups       = [];
$days         = [ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ];
$currentGroup = [];

if ( $group === '1' )
{
	for ( $i = 0; $i < 7; $i ++ )
	{
		$d   = $days[$i];
		$y   = $days[$i - 1];
		$day = $$d;

		if ( $i > 0 )
		{
			$yesterday = $$y;
		}
		else
		{
			$yesterday = microtime(); //just some pseudo-random value
		}

		if ( empty ( $day ) )
		{
			continue;
		}

		if ( $day == $yesterday )
		{
			$currentGroup[1] = $i;
		}
		else
		{
			if ( ! empty( $currentGroup ) )
			{
				$groups[] = $currentGroup;
			}
			$currentGroup = [ $i ]; //re-initialize group
		}
	}
	$groups[] = $currentGroup;
}
else
{
	for ( $i = 0; $i < 7; $i ++ )
	{
		$d   = $days[$i];
		$day = $$d;

		if ( ! empty( $day ) )
		{
			$groups[] = [ $i ];
		}
	}
}
$output = '';
foreach ( $groups as $element )
{
	$output     .= '<span class="group">';
	$outputDays = JText::_( 'MOD_OPENING_HOURS_' . strtoupper( substr( $days[$element[0]], 0, 3 ) ) . '_SHORT' );
	$times      = $days[$element[0]];
	if ( count( $element ) > 1 )
	{
		$outputDays .= '-' . JText::_( 'MOD_OPENING_HOURS_' . strtoupper( substr( $days[$element[1]], 0, 3 ) ) . '_SHORT' );;
	}
	$output .= '<span class="day">' . $outputDays . ':</span> ' . $$times . '<span class="separator"></span></span>';
}
?>

<div class="opening-hours">
	<?php echo $output ?>
</div>
