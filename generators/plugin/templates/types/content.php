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
 * @link https://docs.joomla.org/Plugin/Events/Content
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
	 * onContentPrepare Event
	 *
	 * @param   string   $context  	The context of the content being passed to the plugin.
	 * @param   mixed    &$article	The article object.  Note $article->text is also available
	 * @param   mixed    &$params  	The article params
	 * @param   integer  $page     	Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean	True on success.
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0){
		return true;
	}
	/**
	 * onContentAfterTitle Event
	 *
	 * @param   string   $context  	The context of the content being passed to the plugin.
	 * @param   mixed    &$article	The article object.  Note $article->text is also available
	 * @param   mixed    &$params  	The article params
	 * @param   integer  $page     	Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean	True on success.
	 */
	public function onContentAfterTitle($context, &$article,, &$params, $page = 0){
		return true;
	}
	/**
	 * onContentBeforeDisplay Event
	 *
	 * @param   string   $context  	The context of the content being passed to the plugin.
	 * @param   mixed    &$article	The article object.  Note $article->text is also available
	 * @param   mixed    &$params  	The article params
	 * @param   integer  $page     	Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean	True on success.
	 */
	public function onContentBeforeDisplay($context, &$article,, &$params, $page = 0){
		return true;
	}
	/**
	 * onContentAfterDisplay Event
	 *
	 * @param   string   $context  	The context of the content being passed to the plugin.
	 * @param   mixed    &$article	The article object.  Note $article->text is also available
	 * @param   mixed    &$params  	The article params
	 * @param   integer  $page     	Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean	True on success.
	 */
	public function onContentAfterDisplay($context, &$article,, &$params, $page = 0){
		return true;
	}
	/**
	 * onContentBeforeSave Event
	 *
	 * @param   string  $context  The context of the content passed to the plugin (added in 1.6).
	 * @param   object  $article  A JTableContent object.
	 * @param   bool    $isNew    If the content is just about to be created.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onContentBeforeSave($context, $article, $isNew){
		
	}
	/**
	 * onContentAfterSave Event
	 *
	 * @param   string  $context  The context of the content passed to the plugin (added in 1.6).
	 * @param   object  $article  A JTableContent object.
	 * @param   bool    $isNew    If the content is just about to be created.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onContentAfterSave($context, $article, $isNew){

	}
	/**
	 * Prepare form.
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   mixed  $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since	2.5
	 */
	public function onContentPrepareForm($form, $data){
		return true;
	}
	/**
	 * Runs on content preparation
	 *
	 * @param   string  $context  The context for the data
	 * @param   object  $data     An object containing the data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	public function onContentPrepareData($context, $data){

	}
	/**
	 * onContentBeforeDelete Event
	 *
	 * @param   string  $context  The context for the content passed to the plugin.
	 * @param   object  $data     The data relating to the content that was deleted.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	public function onContentBeforeDelete($context, $data){
		return true;
	}
	/**
	 * onContentAfterDelete Event
	 *
	 * @param   string  $context  The context for the content passed to the plugin.
	 * @param   object  $data     The data relating to the content that was deleted.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	public function onContentAfterDelete($context, $data){
		return true;
	}
	/**
	 * onContentChangeState Event
	 *
	 * @param   string   $context  The context for the content passed to the plugin.
	 * @param   array    $pks      A list of primary key ids of the content that has changed state.
	 * @param   integer  $value    The value of the state that the content has been changed to.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onContentChangeState($context, $pks, $value){

	}
	/**
	 * onContentSearch Event
	 *
	 * The SQL must return the following fields that are used in a common display
	 * routine: href, title, section, created, text, browsernav.
	 *
	 * @param   string  $text      Target search string.
	 * @param   string  $phrase    Matching option (possible values: exact|any|all).  Default is "any".
	 * @param   string  $ordering  Ordering option (possible values: newest|oldest|popular|alpha|category).  Default is "newest".
	 * @param   mixed   $areas     An array if the search is to be restricted to areas or null to search all areas.
	 *
	 * @return  array  Search results.
	 *
	 * @since   1.6
	 */
	public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null){
		return [];
	}
	/**
	 * Determine areas searchable by this plugin.
	 *
	 * @return  array  An array of search areas.
	 *
	 * @since   1.6
	 */
	public function onContentSearchAreas(){
		return [];
	}
}
