<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelItemName%>
 *
 */
defined('_JEXEC') or die;

/**
 * <%=s.capitalize(data.modelItemName)%> controller class.
 *
 * @since  1.6
 */
class <%=data.names.item.controller%> extends JControllerForm{

  /**
   * Dummy save method
   *
   * @return  boolean  True on success sending the email. False on failure.
   *
   */
  public function save($key = null, $urlVar = null){
    // Check for request forgeries.
    JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

    $app    = JFactory::getApplication();
    $model  = $this->getModel();
    $params = JComponentHelper::getParams('com_<%=data.projectName%>');

    // Get the data from POST
    $data    = $this->input->post->get('jform', array(), 'array');
    return parent::save($key, $urlVar);
  }

  /**
   * Method override to check if you can add a new record.
   *
   * @param   array  $data  An array of input data.
   *
   * @return  boolean
   *
   * @since   1.6
   */
  protected function allowAdd($data=array()){
    return parent::allowAdd($data=array());
    /*
      $user=JFactory::getUser();
      $filter=$this->input->getInt('filter_category_id');
      $categoryId=JArrayHelper::getValue($data,'catid',$filter,'int');
      $allow=null;

      if($categoryId){
      // If the category has been passed in the URL check it.
      $allow=$user->authorise('core.create',$this->option.'.category.'.$categoryId);
      }

      if($allow === null){
      // In the absence of better information, revert to the component permissions.
      return parent::allowAdd($data);
      }else{
      return $allow;
      }
     */
  }

  /**
   * Method override to check if you can edit an existing record.
   *
   * @param   array   $data  An array of input data.
   * @param   string  $key   The name of the key for the primary key.
   *
   * @return  boolean
   *
   * @since   1.6
   */
  protected function allowEdit($data=array(),$key='id'){
    return parent::allowEdit($data=array(),$key='id');
    /*
      $user=JFactory::getUser();
      $recordId=(int)isset($data[$key])?$data[$key]:0;
      $categoryId=0;

      if($recordId){
      $categoryId=(int)$this->getModel()->getItem($recordId)->catid;
      }

      if($categoryId){
      // The category has been set. Check the category permissions.
      return $user->authorise('core.edit',$this->option.'.category.'.$categoryId);
      }else{
      // Since there is no asset tracking, revert to the component permissions.
      return parent::allowEdit($data,$key);
      }
     */
  }
  /**
   * Method to get a model object, loading it if required.
   *
   * @param   string  $name    The model name. Optional.
   * @param   string  $prefix  The class prefix. Optional.
   * @param   array   $config  Configuration array for model. Optional.
   *
   * @return  <%=data.names.item.model%>  The model.
   *
   */
  public function getModel($name = '<%=s.capitalize(data.modelItemName)%>', $prefix = '<%=s.capitalize(data.projectName)%>Model', $config = array('ignore_request' => true)){
    if (empty($name)){
      $name = $this->context;
    }

    return parent::getModel($name, $prefix, $config);
  }

}
