<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelItemName%>
 *
 */
defined('_JEXEC') or die;


/**
 * <%=s.capitalize(data.projectName)%> Table
 *
 */
class <%=data.names.item.table%> extends JTable{
  <% data.fields.forEach(function(field){ %>
  /**
  * <%=s.humanize(field.name)%>
  *
  * @var <%=paramToPhp(field.type)%>
  */
  public $<%=field.name%>;
 <% });%>

  /**
   * Constructor
   *
   * @param   JDatabaseDriver  &$_db  Database connector object
   *
   */
  public function __construct(&$_db){
    parent::__construct('#__<%=data.projectName%>_<%=data.modelItemName%>','id',$_db);
  }

}
