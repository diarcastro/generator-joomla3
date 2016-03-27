<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelItemName%>
 *
 */
defined('_JEXEC') or die;

/**
 * View to edit a <%=s.capitalize(data.modelItemName)%>.
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
	* Saved status
	*
	* @var JObject
	*/
	protected $params;
	/**
	* Saved status
	*
	* @var JObject
	*/
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 * @since   1.5
	 */
	public function display($tpl = null){
		// Get the view data.
		$this->form   = $this->get('Form');
		$this->state  = $this->get('State');
		$this->params = JComponentHelper::getParams('<%=data.componentName%>');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 *
	 * @return  void
	 *
	 */
	protected function prepareDocument(){
		$app   = JFactory::getApplication();
		$menus = $app->getMenu();
		$user  = JFactory::getUser();
		$login = $user->get('guest') ? true : false;
		$title = null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		/*
		if ($menu){
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else{
			$this->params->def('page_heading', '<%=data.componentName.uCase()%>_VIEW_<%=data.modelItemName.uCase()%>_TITLE');
		}

		$title = $this->params->get('page_title', '');

		if (empty($title)){
			$title = $app->get('sitename');
		}
		elseif ($app->get('sitename_pagetitles', 0) == 1){
			$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
		}
		elseif ($app->get('sitename_pagetitles', 0) == 2){
			$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
		}

		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description')){
			//$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords')){
			//$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots')){
			//$this->document->setMetadata('robots', $this->params->get('robots'));
		}
		*/
	}
}
