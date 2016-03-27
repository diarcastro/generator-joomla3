<?php
/**
 * @package     Joomla.Site
 * @subpackage  <%=componentName%>
 *
 * @license     <%=license%>
 */

defined('_JEXEC') or die;

/**
 * <%=s.capitalize(projectName)%> Controller
 *
 */
class <%=s.capitalize(projectName)%>Controller extends JControllerLegacy
{
	/**
   * Method to display a view.
   *
   * @param   boolean  $cachable   If true, the view output will be cached
   * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
   *
   * @return  JController		This object to support chaining.
   *
   * @since   1.5
   */
  public function display($cachable=false,$urlparams=false){
  
    parent::display($cachable,$urlparams);
    return $this;
  }
}
