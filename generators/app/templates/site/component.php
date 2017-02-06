<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_<%=projectName%>
 *
 * @license     <%=license%>
 */

defined('_JEXEC') or die;
if(file_exists(__DIR__.'/vendor/autoload.php')){
  include __DIR__.'/vendor/autoload.php';
}

$controller = JControllerLegacy::getInstance('<%=s.capitalize(projectName)%>');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
