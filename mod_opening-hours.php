<?php
/**
 * @package    opening-hours
 *
 * @author     Christian Friedemann <c.friedemann@pixelstun.de>
 * @copyright  2019 pixelstun.de
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://pixelstun.de
 */

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require ModuleHelper::getLayoutPath('mod_opening-hours', $params->get('layout', 'default'));
