<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  <%=componentName%>
 *
 * @license     <%=license%>
 */
defined('_JEXEC') or die;

/**
 * <%=s.capitalize(projectName)%> component helper.
 *
 * @since  1.6
 */
class <%=s.capitalize(projectName)%>Helper extends JHelperContent{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function addSubmenu($vName){
		JHtmlSidebar::addEntry(
			JText::_('<%=s(componentName).toUpperCase().value()%>_SUBMENU_<%=s(defaultView).toUpperCase().value()%>'),
			'index.php?option=com_<%=projectName%>&view=<%=defaultView%>',
			$vName == '<%=defaultView%>'
		);
		/*--EOS EndOfSection: Dont't remove for future submenus generation--*/
	}
}
