<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelItemName%>
 *
 */
defined('_JEXEC') or die;

/**
 * View to edit a <%=data.modelItemName%>.
 *
 */
class <%=data.names.item.view%> extends JViewLegacy{
	/**
	* Form
	*
	* @var JForm
	*/
	protected $form;

	/**
	* Current Row
	*
	* @var Array
	*/
	protected $item;

	/**
	* Saved status
	*
	* @var JObject
	*/
	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null){
		// Initialiase variables.
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar(){

		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		$isNew      = ($this->item->id == 0);
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		// Since we don't track these assets at the item level, use the <%=data.modelItemName%> id.
		$canDo = JHelperContent::getActions('<%=data.componentName%>', '<%=data.modelItemName%>', $this->item->id);

		JToolbarHelper::title($isNew ? JText::_('<%=data.componentName.uCase()%>_MANAGER_<%=data.modelItemName.uCase()%>_NEW') : JText::_('<%=data.componentName.uCase()%>_MANAGER_<%=data.modelItemName.uCase()%>_EDIT'), 'icon <%=data.projectName%> <%=data.modelItemName%>');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || $user->authorise('<%=data.componentName%>', 'core.create'))){
			JToolbarHelper::apply('<%=data.modelItemName%>.apply');
			JToolbarHelper::save('<%=data.modelItemName%>.save');

			if ($canDo->get('core.create')){
				JToolbarHelper::save2new('<%=data.modelItemName%>.save2new');
			}
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')){
			JToolbarHelper::save2copy('<%=data.modelItemName%>.save2copy');
		}

		if (empty($this->item->id)){
			JToolbarHelper::cancel('<%=data.modelItemName%>.cancel');
		}
		else{
			if ($this->state->params->get('save_history', 0) && $user->authorise('core.edit')){
				JToolbarHelper::versions('com_<%=data.projectName%>.<%=data.modelItemName%>', $this->item->id);
			}

			JToolbarHelper::cancel('<%=data.modelItemName%>.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		//JToolbarHelper::help('JHELP_COMPONENTS_<%=data.projectName.uCase()%>_<%=data.projectName.uCase()%>_EDIT');
	}
}
