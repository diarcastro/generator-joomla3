<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  <%=s.capitalize(data.type)%>.<%=data.plugin%>
 *
 * @copyright
 * @license     <%=data.license%>
 */

defined('_JEXEC') or die;

/**
 * <%=s.capitalize(data.plugin)%> plugin class.
 *
 * @since  2.5
 * @link https://docs.joomla.org/Plugin/Events/Contact
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
   * This event is triggered after a contact form has been submitted. An example use case would be validating a captcha. If you return a Exception object form submission will be terminated.
   *
   * @param JObject $contact A reference to the person who will receive the form.
   * @param arrat $data    A reference to the data in the $_POST variable.
   * @return boolean true or false
   */
 public function onValidateContact($contact, $data){
   return true;
 }
 /**
  * This event is triggered after a contact form has been submitted. You can use this for sending additional mails etc.
  *
  * @param JObject $contact A reference to the person who will receive the form.
  * @param arrat $data    A reference to the data in the $_POST variable.
  * @return boolean true or false
  */
 public function onSubmitContact($contact, $data){
   return true;
 }
}
