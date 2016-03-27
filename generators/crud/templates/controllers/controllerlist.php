<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelListName%>
 *
 */
defined('_JEXEC') or die;

/**
 * <%=s.capitalize(data.modelListName)%> controller class.
 *
 * @since  1.6
 */
class <%=data.names.list.controller%> extends JControllerAdmin{
  /**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = '<%=data.componentName.uCase()%>_<%=data.modelListName.uCase()%>';
  /**
   * Constructor.
   *
   * @param   array  $config  An optional associative array of configuration settings.
   *
   * @see     JController
   * @since   1.6
   */
  public function __construct($config=array()){
    parent::__construct($config);
  }

  /**
   * Method to get a model object, loading it if required.
   *
   * @param   string  $name    The model name. Optional.
   * @param   string  $prefix  The class prefix. Optional.
   * @param   array   $config  Configuration array for model. Optional.
   *
   * @return  <%=data.names.item.model%> The model.
   *
   * @since   12.2
   */
  public function getModel($name = '<%=s.capitalize(data.modelItemName)%>', $prefix = '<%=s.capitalize(data.projectName)%>Model', $config = array('ignore_request' => true)){
    if (empty($name)){
      $name = $this->context;
    }

    return parent::getModel($name, $prefix, $config);
  }

  /**
   * Removes an item.
   *
   * Overrides JControllerAdmin::delete to check the core.admin permission.
   *
   * @return  boolean  Returns true on success, false on failure.
   *
   * @since   1.6
   */
  public function delete(){
    // if(!JFactory::getUser()->authorise('core.admin',$this->option)){
    //   JError::raiseError(500,JText::_('JERROR_ALERTNOAUTHOR'));
    //   jexit();
    // }

    return parent::delete();
  }

  /**
   * Method to publish a list of records.
   *
   * Overrides JControllerAdmin::publish to check the core.admin permission.
   *
   * @return  void
   *
   * @since   1.6
   */
  public function publish(){
    // if(!JFactory::getUser()->authorise('core.admin',$this->option)){
    //   JError::raiseError(500,JText::_('JERROR_ALERTNOAUTHOR'));
    //   jexit();
    // }

    return parent::publish();
  }

  /**
   * Changes the order of one or more records.
   *
   * Overrides JControllerAdmin::reorder to check the core.admin permission.
   *
   * @return  boolean  True on success
   *
   * @since   1.6
   */
  public function reorder(){
    // if(!JFactory::getUser()->authorise('core.admin',$this->option)){
    //   JError::raiseError(500,JText::_('JERROR_ALERTNOAUTHOR'));
    //   jexit();
    // }

    return parent::reorder();
  }

  /**
   * Method to save the submitted ordering values for records.
   *
   * Overrides JControllerAdmin::saveorder to check the core.admin permission.
   *
   * @return  boolean  True on success
   *
   * @since   1.6
   */
  public function saveorder(){
    // if(!JFactory::getUser()->authorise('core.admin',$this->option)){
    //   JError::raiseError(500,JText::_('JERROR_ALERTNOAUTHOR'));
    //   jexit();
    // }

    return parent::saveorder();
  }

}
