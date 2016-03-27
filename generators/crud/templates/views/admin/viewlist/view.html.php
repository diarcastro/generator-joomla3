<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelListName%>
 *
 */

defined('_JEXEC') or die;

/**
 * View class for a list of <%=data.modelListName%>.
 *
 */
class <%=data.names.list.view%> extends JViewLegacy{
	/**
	* Current list items
	*
	* @var array
	*/
	protected $items;
	/**
	* JPagination Object
	*
	* @var JPagination
	*/
	protected $pagination;

	/**
	* States object
	*
	* @var JObject
	*/
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 */
	public function display($tpl = null){
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		<%=s.capitalize(data.projectName)%>Helper::addSubmenu('<%=data.modelListName%>');

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 */
	protected function addToolbar(){

		$canDo = JHelperContent::getActions('<%=data.componentName%>', '<%=data.modelListName%>', $this->state->get('filter.<%=data.modelItemName%>_id'));
		$user = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('<%=data.componentName.uCase()%>_MANAGER_<%=data.modelListName.uCase()%>'), '<%=data.projectName%> <%=data.modelListName%>');

		if ($user->authorise('<%=data.componentName%>', 'core.create')){
			JToolbarHelper::addNew('<%=data.modelItemName%>.add');
		}

		if (($canDo->get('core.edit'))){
			JToolbarHelper::editList('<%=data.modelItemName%>.edit');
		}

		if ($canDo->get('core.edit.state')){
			if ($this->state->get('filter.state') != 2){
				JToolbarHelper::publish('<%=data.modelListName%>.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('<%=data.modelListName%>.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1){
				if ($this->state->get('filter.state') != 2){
					JToolbarHelper::archiveList('<%=data.modelListName%>.archive');
				}
				elseif ($this->state->get('filter.state') == 2){
					JToolbarHelper::unarchiveList('<%=data.modelListName%>.publish');
				}
			}
		}

		// if ($canDo->get('core.edit.state')){
		// 	JToolbarHelper::checkin('<%=data.modelListName%>.checkin');
		// }

		// Add a batch button
		if ($user->authorise('core.create', '<%=data.componentName%>')
			&& $user->authorise('core.edit', '<%=data.componentName%>')
			&& $user->authorise('core.edit.state', '<%=data.componentName%>'))
		{
			$title = JText::_('JTOOLBAR_BATCH');

			// Instantiate a new JLayoutFile instance and render the batch button
			$layout = new JLayoutFile('joomla.toolbar.batch');

			$dhtml = $layout->render(array('title' => $title));
			$bar->appendButton('Custom', $dhtml, 'batch');
		}

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete')){
			JToolbarHelper::deleteList('', '<%=data.modelListName%>.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state')){
			JToolbarHelper::trash('<%=data.modelListName%>.trash');
		}

		if ($user->authorise('core.admin', '<%=data.componentName%>') || $user->authorise('core.options', '<%=data.componentName%>')){
			JToolbarHelper::preferences('<%=data.componentName%>');
		}

		JToolbarHelper::help('JHELP_COMPONENTS_<%=data.componentName.uCase()%>_<%=data.modelListName.uCase()%>');
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields(){
		return [
			<% data.fields.forEach(function(field){ %>'<%=field.name%>'=>JText::_('<%=data.componentName.uCase()%>_HEADING_<%=field.name.uCase()%>'),
			<% })%>
		];
	}
}
