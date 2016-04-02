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
 * @link https://docs.joomla.org/Plugin/Events/System
 */
class Plg<%=s.capitalize(data.type)%><%=s.capitalize(data.plugin)%> extends JPlugin{
  /**
	 * After initialise.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public function onAfterInitialise(){

  }
  /**
	 * After route.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function onAfterRoute(){

  }
  /**
	 * After Dispatch.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function onAfterDispatch(){

  }
  /**
	 * Before Render.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function onBeforeRender(){

  }
  /**
	 * After Render.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function onAfterRender(){

  }
  /**
	 * Before Compile Head.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function onBeforeCompileHead(){

  }
  /**
	 * Search.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	/**
	 * Search
	 * @param  string $searchword   The target search string
	 * @param  string $searchphrase A string matching option (exact|any|all).
	 * @param  string $ordering     A string ordering option (newest|oldest|popular|alpha|category)
	 * @param  array $areas        An array if restricted to areas, null if search all.
	 * @return array              Array of stdClass objects with members as described above.
	 */
	public function onSearch($searchword,$searchphrase,$ordering,$areas){
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
