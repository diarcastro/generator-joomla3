<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelListName%>
 *
 */

defined('_JEXEC') or die;

/**
 * <%=s.capitalize(data.modelListName)%> model.
 *
 */
class <%=data.names.list.model%> extends JModelList{

  /**
   * Constructor.
   *
   * @param   array  $config  An optional associative array of configuration settings.
   *
   * @see     JController
   * @since   1.6
   */
  public function __construct($config=array()){
    if(empty($config['filter_fields'])){
      $config['filter_fields']=[
        <% data.fields.forEach(function(field){ %>'<%=field.name%>'=>'a.<%=field.name%>',
        <% })%>
      ];
    }

    parent::__construct($config);
  }


  /**
   * Build an SQL query to load the list data.
   *
   * @return  JDatabaseQuery
   *
   * @since   1.6
   */
  protected function getListQuery(){
    $db=$this->getDbo();
    $query=$db->getQuery(true);
    $query->select([
      <%if(data.fields.length==0){%>'*'<%}%>
      <% data.fields.forEach(function(field){%>'a.<%=field.name%>',
      <% })%>
    ])->from('#__<%=data.projectName%>_<%=data.modelItemName%> a');
    <% if(data.formFields.published){ %>
    // Filter by published published
    $published=$this->getState('filter.published');

    if(is_numeric($published)){
      $query->where('a.published = '.(int)$published);
    }elseif($published === ''){
      $query->where('(a.published IN (0, 1))');
    }
    <% }%>

    // Filter by search in title
    $search=$this->getState('filter.search');

    if(!empty($search)){
      $query->where(<% data.fields.forEach(function(field,index){%>'a.<%=field.name%> LIKE '.$db->quote('%'.$search.'%')<%if(field.name!=data.fields[data.fields.length-1].name){%>.' OR '. <%}%><%})%>);
    }
    <%if(data.formFields.language){%>
    if($language=$this->getState('filter.language')){
      $query->where('a.language = '.$db->quote($language));
    }
    <%}%>
    $orderCol=$this->state->get('list.ordering','ordering');
    $orderDirn=$this->state->get('list.direction','ASC');

    $query->order($db->escape($orderCol.' '.$orderDirn));

    return $query;
  }

  /**
   * Method to get a store id based on model configuration state.
   *
   * This is necessary because the model is used by the component and
   * different modules that might need different sets of data or different
   * ordering requirements.
   *
   * @param   string  $id  A prefix for the store id.
   *
   * @return  string  A store id.
   *
   * @since   1.6
   */
  protected function getStoreId($id=''){
    // Compile the store id.
    $id .= ':'.$this->getState('filter.search');
    <%if(data.formFields.published){%>
    $id .= ':'.$this->getState('filter.published');
    <%}%>
    <%if(data.formFields.language){%>
    $id .= ':'.$this->getState('filter.language');
    <%}%>
    return parent::getStoreId($id);
  }

  /**
   * Returns a reference to the a Table object, always creating it.
   *
   * @param   string  $type    The table type to instantiate
   * @param   string  $prefix  A prefix for the table class name. Optional.
   * @param   array   $config  Configuration array for model. Optional.
   *
   * @return  <%=data.names.item.table %> A database object
   *
   * @since   1.6
   */
  public function getTable($type='<%=s.capitalize(data.modelItemName)%>',$prefix='<%=s.capitalize(data.projectName)%>Table',$config=array()){
    return JTable::getInstance($type,$prefix,$config);
  }

  /**
   * Method to auto-populate the model state.
   *
   * Note. Calling getState in this method will result in recursion.
   *
   * @param   string  $ordering   An optional ordering field.
   * @param   string  $direction  An optional direction (asc|desc).
   *
   */
  protected function populateState($ordering=null,$direction=null){
    // Load the filter state.
    $search=$this->getUserStateFromRequest($this->context.'.filter.search','filter_search');
    $this->setState('filter.search',$search);
    <%if(data.formFields.published){%>
    $published=$this->getUserStateFromRequest($this->context.'.filter.published','filter_published','','string');
    $this->setState('filter.published',$published);
    <%}%>
    <%if(data.formFields.language){%>
    $language=$this->getUserStateFromRequest($this->context.'.filter.language','filter_language','');
    $this->setState('filter.language',$language);
    <%}%>
    // Load the parameters.
    $params=JComponentHelper::getParams('<%=data.componentName%>');
    $this->setState('params',$params);

    // List state information.
    parent::populateState('a.<%=firstStringField()%>','asc');
  }

}
