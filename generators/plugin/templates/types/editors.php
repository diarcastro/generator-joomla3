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
 * @link https://docs.joomla.org/Plugin/Events/Editor
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
	 * Initialises the Editor.
	 *
	 * @return  string  JavaScript Initialization string
	 *
	 * @since   1.5
	 */
	public function onInit(){
		return '<script type="text/javascript"></script>';
	}
	/**
	 * Display the editor area.
	 *
	 * @param   string   $name     The name of the editor area.
	 * @param   string   $content  The content of the field.
	 * @param   string   $width    The width of the editor area.
	 * @param   string   $height   The height of the editor area.
	 * @param   int      $col      The number of columns for the editor area.
	 * @param   int      $row      The number of rows for the editor area.
	 * @param   boolean  $buttons  True and the editor buttons will be displayed.
	 * @param   string   $id       An optional ID for the textarea. If not supplied the name is used.
	 * @param   string   $asset    The object asset
	 * @param   object   $author   The author.
	 *
	 * @return  string
	 */
	public function onDisplay($name, $content, $width, $height, $col, $row, $buttons = true, $id = null, $asset = null, $author = null){
		return '';
	}
	/**
	 * Get the editor content
	 *
	 * @param   string  $editor  The name of the editor
	 *
	 * @return  string
	 */
	public function onGetContent($editor){
		return '';
	}
	/**
	 * Set the editor content
	 *
	 * @param   string  $editor  The name of the editor
	 * @param   string  $html    The html to place in the editor
	 *
	 * @return  string
	 */
	public function onSetContent($editor, $html){
		// TODO: Set content and return content
		return $html;
	}
	/**
	 * onSave Event
	 *
	 * @param   string  $editor  The name of the editor
	 *
	 * @return  string
	 */
	public function onSave($editor){
		return '';
	}
	/**
	 * Inserts html code into the editor
	 *
	 * @param   string  $name  The name of the editor
	 *
	 * @return  void
	 *
	 */
	public function onGetInsertMethod($name){
		return;
	}
}
