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
 * @link https://docs.joomla.org/Plugin/Events/Captcha
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
	 * Initialise the captcha
	 *
	 * @param   string  $id  The id of the field.
	 *
	 * @return  Boolean	True on success, false otherwise
	 *
	 * @throws  Exception
	 *
	 * @since  2.5
	 */
	public function onInit($id = 'dynamic_captcha_1'){
		return true;
	}

	/**
	 * Gets the challenge HTML
	 *
	 * @param   string  $name   The name of the field. Not Used.
	 * @param   string  $id     The id of the field.
	 * @param   string  $class  The class of the field. This should be passed as
	 *                          e.g. 'class="required"'.
	 *
	 * @return  string  The HTML to be embedded in the form.
	 *
	 * @since  2.5
	 */
	public function onDisplay($name = null, $id = 'dynamic_captcha_1', $class = ''){
		return '';
	}

	/**
	 * Calls an HTTP POST function to verify if the user's guess was correct
	 *
	 * @param   string  $code  Answer provided by user. Not needed for the Recaptcha implementation
	 *
	 * @return  True if the answer is correct, false otherwise
	 *
	 * @since  2.5
	 */
	public function onCheckAnswer($code = null){
		return true;
	}
}
