<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  <%=componentName%>
 *
 * @license     <%=license%>
 */
defined('_JEXEC') or die;

/**
 * <%=s.capitalize(projectName)%> master display controller.
 *
 * @since  1.6
 */
class <%=s.capitalize(projectName)%>Controller extends JControllerLegacy{

  /**
   * Method to display a view.
   *
   * @param   boolean  $cachable   If true, the view output will be cached
   * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
   *
   * @return  JController		This object to support chaining.
   *
   * @since   1.5
   */
  public function display($cachable=false,$urlparams=false){
    $view=$this->input->get('view','<%=defaultView%>');
    $layout=$this->input->get('layout','default');
    $id=$this->input->getInt('id');
    $this->input->set('view',$view);
    // Check for edit form.
    if($view == '<%=pluralize.singular(defaultView)%>' && $layout == 'edit' && !$this->checkEditId('<%=componentName%>.edit.<%=pluralize.singular(defaultView)%>',$id)){
      // Somehow the person just went to the form - we don't allow that.
      $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID',$id));
      $this->setMessage($this->getError(),'error');
      $this->setRedirect(JRoute::_('index.php?option=<%=componentName%>&view=<%=defaultView%>',false));

      return false;
    }

    parent::display($cachable,$urlparams);

    return $this;
  }

}
