<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelListName%>
 *
 */
 /* @var $this <%=data.names.item.view%> */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
//$canOrder  = $user->authorise('core.edit.state', '<%=data.componentName%>.category');
$archived  = $this->state->get('filter.published') == 2 ? true : false;
$trashed   = $this->state->get('filter.published') == -2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder){
	$saveOrderingUrl = 'index.php?option=<%=data.componentName%>&task=<%=data.modelListName%>.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<form action="<?php echo JRoute::_('index.php?option=<%=data.componentName%>&view=<%=data.modelListName%>'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
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
						<% if(data.formFields.ordering) {%><th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
						<% } %>
						<th width="1%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<% data.fields.forEach(function(field){ %>
						<th class="nowrap center">
						<% if(field.name!='ordering' && field.name!='published'){ %><?php echo JHtml::_('searchtools.sort', '<%=data.componentName.uCase()%>_HEADING_<%=field.name.uCase()%>', 'a.<%=field.name%>', $listDirn, $listOrder); ?>
							<% } %>
						</th><% }) %>
				</thead>
				<tfoot>
					<tr>
						<td colspan="13">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($this->items as $i => $item) :
						$canCreate  = $user->authorise('core.create');
						$canEdit    = $user->authorise('core.edit');
						//$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
						$canChange  = $user->authorise('core.edit.state');// && $canCheckin;
						?>
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php //echo $item->catid; ?>">
							<% if(data.formFields.ordering){ %>
							<td class="order nowrap center hidden-phone">
								<?php
								$iconClass = '';
								if (!$canChange)
								{
									$iconClass = ' inactive';
								}
								elseif (!$saveOrder)
								{
									$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
								}
								?>
								<span class="sortable-handler <?php echo $iconClass ?>">
									<span class="icon-menu"></span>
								</span>
								<?php if ($canChange && $saveOrder) : ?>
									<input type="text" style="display:none" name="order[]" size="5"
										value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
								<?php endif; ?>
							</td>
							<% } %>
							<% if(data.formFields.id){ %>
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<% } %>
							<% if(data.formFields.published){ %>
							<td class="center">
								<div class="btn-group">
									<?php echo JHtml::_('jgrid.published', $item->published, $i, '<%=data.modelListName%>.', $canChange, 'cb', $item->publish_up?:null, $item->publish_down?:null); ?>
									<?php
									// Create dropdown items
									$action = $archived ? 'unarchive' : 'archive';
									JHtml::_('actionsdropdown.' . $action, 'cb' . $i, '<%=data.modelListName%>');

									$action = $trashed ? 'untrash' : 'trash';
									JHtml::_('actionsdropdown.' . $action, 'cb' . $i, '<%=data.modelListName%>');

									// Render dropdown list
									echo JHtml::_('actionsdropdown.render', $this->escape($item-><%=firstStringField()%>));
									?>
								</div>
							</td>
							<% } %>
							<td class="nowrap has-context">
								<div class="pull-left">
									<?php if ($item->checked_out) : ?>
										<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, '<%=data.modelListName%>.', $canCheckin); ?>
									<?php endif; ?>
									<?php if ($canEdit) : ?>
										<a href="<?php echo JRoute::_('index.php?option=<%=data.componentName%>&task=<%=data.modelItemName%>.edit&id=' . (int) $item->id); ?>">
											<?php echo $this->escape($item-><%=firstStringField()%>); ?></a>
									<?php else : ?>
										<?php echo $this->escape($item-><%=firstStringField()%>); ?>
									<?php endif; ?>
									<% if(data.formFields.alias){ %>
									<span class="small">
										<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias)); ?>
									</span>
									<% } %>
								</div>
							</td>
							<% data.fields.forEach(function(field){ %>
								<% if(field.name!='id' && field.name!='ordering' && field.name!='published'){ %>
							<td class="small nowrap hidden-phone">
								<?php echo $this->escape($item-><%=field.name%>); ?>
							</td><% } %>
							<% })%>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php // Load the batch processing form. ?>
			<?php if ($user->authorise('core.create', '<%=data.componentName%>')
				&& $user->authorise('core.edit', '<%=data.componentName%>')
				&& $user->authorise('core.edit.state', '<%=data.componentName%>')) : ?>
				<?php echo JHtml::_(
					'bootstrap.renderModal',
					'collapseModal',
					array(
						'title' => JText::_('<%=data.componentName.uCase()%>_BATCH_OPTIONS'),
						'footer' => $this->loadTemplate('batch_footer')
					),
					$this->loadTemplate('batch_body')
				); ?>
			<?php endif; ?>
		<?php endif; ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
