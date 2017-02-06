<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  <%=s.capitalize(data.type)%>.<%=data.customName%>
 *
 * @copyright
 * @license     <%=data.license%>
 */

defined('_JEXEC') or die;

/**
 * <%=s.capitalize(data.customName)%> plugin class.
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.customName)%> extends JPlugin{
  /**
   * Custom Event
   *
   * @return boolean
   */
  public function onCustomEvent(){
    return true;
  }
}
