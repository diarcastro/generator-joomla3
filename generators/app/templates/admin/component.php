<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  <%=componentName%>
 *
 * @license     <%=license%>
 */
defined('_JEXEC') or die;
if(file_exists(JPATH_COMPONENT.'/vendor/autoload.php')){
  include JPATH_COMPONENT.'/vendor/autoload.php';
}

if(!JFactory::getUser()->authorise('core.manage','<%=componentName%>')){
  return JError::raiseWarning(404,JText::_('JERROR_ALERTNOAUTHOR'));
}
if(file_exists(JPATH_COMPONENT.'/helpers/<%=projectName%>.php')){
  JLoader::register('<%=s.capitalize(projectName)%>Helper', JPATH_COMPONENT . '/helpers/<%=projectName%>.php');
}

// Execute the task.
$controller=JControllerLegacy::getInstance('<%=s.capitalize(projectName)%>');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
