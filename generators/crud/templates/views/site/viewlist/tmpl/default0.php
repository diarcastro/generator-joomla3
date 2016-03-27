<?php

defined('_JEXEC') or die;
/* @var $this <%=data.names.list.view%> */
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
//$canOrder  = $user->authorise('core.edit.state', '<%=data.componentName%>.category');
$archived  = $this->state->get('filter.state') == 2 ? true : false;
$trashed   = $this->state->get('filter.state') == -2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=<%=data.componentName%>&task=<%=data.modelListName%>.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<div id="data-list">
	<div id="j-sidebar-container" class="span2">
		<?php //echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php
		// Search tools bar
		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped" id="articleList">
				<thead>
					<tr>
						<!-- <th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
						<th width="1%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th> -->
						<!-- <th width="1%" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th> -->
						<% data.fields.forEach(function(field){ %><th>
								<?php echo JHtml::_('searchtools.sort', 'COM_<%=data.projectName.uCase()%>_HEADING_<%=field.name.uCase()%>', 'a.<%=field.name%>', $listDirn, $listOrder); ?>
							</th><%}%>
						<!-- <th width="1%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th> -->
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="13">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($this->items as $i => $item) :?>
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php //echo $item->catid; ?>">
							<% data.fields.forEach(function(field){ %> <td><?php echo $this->escape($item-><%=field.name%>);?></td><% }) %>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	</div>
</div>
