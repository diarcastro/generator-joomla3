<?php

defined('_JEXEC') or die;
/* @var $this <%=data.names.list.view%> */
// JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
//
// JHtml::_('bootstrap.tooltip');
// JHtml::_('behavior.multiselect');
// JHtml::_('formbehavior.chosen', 'select');
//
// $user      = JFactory::getUser();
// $userId    = $user->get('id');
// $listOrder = $this->escape($this->state->get('list.ordering'));
// $listDirn  = $this->escape($this->state->get('list.direction'));
// //$canOrder  = $user->authorise('core.edit.state', '<%=data.componentName%>.category');
// $archived  = $this->state->get('filter.state') == 2 ? true : false;
// $trashed   = $this->state->get('filter.state') == -2 ? true : false;
// $saveOrder = $listOrder == 'a.ordering';
//
// if ($saveOrder)
// {
// 	$saveOrderingUrl = 'index.php?option=<%=data.componentName%>&task=<%=data.modelListName%>.saveOrderAjax&tmpl=component';
// 	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
// }
?>
<?php if(!count($this->items)):?>
<div class="alert alert-no-items">
	<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
</div>
<?php else:?>
	<pre>
		<?php print_r($this->items); ?>
	</pre>
<?php endif;?>
