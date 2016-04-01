<?php
/**
 * @package     Joomla.Site
 * @subpackage  <%=data.moduleName%>
 *
 * @copyright
 * @license     <%=data.license%>
 */

defined('_JEXEC') or die;
/* @var $param \Joomla\Registry\Registry */

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('<%=data.moduleName%>', $params->get('layout', 'default'));
