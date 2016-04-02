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
 * @link https://docs.joomla.org/Plugin/Events/User
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
	 * Method is called before user data is stored in the database
	 *
	 * @param   array    $user   Holds the old user data.
	 * @param   boolean  $isnew  True if a new user is stored.
	 * @param   array    $data   Holds the new user data.
	 *
	 * @return    boolean
	 *
	 * @since   3.1
	 * @throws    InvalidArgumentException on invalid date.
	 */
	public function onUserBeforeSave($user, $isnew, $data){
    return true;
  }
  /**
	 * Saves user profile data
	 *
	 * @param   array    $data    entered user data
	 * @param   boolean  $isNew   true if this is a new user
	 * @param   boolean  $result  true if saving the user worked
	 * @param   string   $error   error message
	 *
	 * @return bool
	 */
	public function onUserAfterSave($data, $isNew, $result, $error){
    return true;
  }
  /**
   * onUserAfterDelete
   * @param  array $user   An associative array of the columns in the user table.
   * @param  boolean $succes Boolean to identify if the deletion was successful
   * @param  JError $msg    Error message if delete failed (JError object detailing the error, if any)
   * @return void
   */
	public function onUserAfterDelete($user, $succes, $msg){

  }
  /**
	 * This method should handle any login logic and report back to the subject
	 *
	 * @param   array  $user     Holds the user data
	 * @param   array  $options  Array holding options (remember, autoregister, group)
	 *
	 * @return  boolean  True on success
	 *
	 * @since   1.5
	 */
	public function onUserLogin($user, $options = array()){
    return true;
  }
  /**
	 * Called if user fails to be logged in.
	 *
	 * @param   array  $response  Array of response data.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public function onUserLoginFailure($response){

  }
  /**
	 * onUserAfterLogin Event
	 *
	 * @param   array  $options  Array holding options
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.2
	 */
	public function onUserAfterLogin($options){

  }
  /**
	 * This method should handle any logout logic and report back to the subject
	 *
	 * @param   array  $user     Holds the user data.
	 * @param   array  $options  Array holding options (client, ...).
	 *
	 * @return  object  True on success
	 *
	 * @since   1.5
	 */
	public function onUserLogout($user, $options = array()){
    return true;
  }
  /**
	 * This method should handle any authentication and report back to the subject
	 *
	 * @param   array   $credentials  Array holding the user credentials
	 * @param   array   $options      Array of extra options
	 * @param   object  &$response    Authentication response object
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public function onUserAuthenticate($credentials, $options, &$response){

  }
  /****** Undocument mothods *****/
  public function onUserAuthorisation(){}
  public function onUserAuthorisationFailure(){}
  public function onUserBeforeSaveGroup(){}
  public function onUserAfterSaveGroup(){}
  public function onUserBeforeDeleteGroup(){}
  public function onUserAfterDeleteGroup(){}

}
