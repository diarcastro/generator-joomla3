<?php
/**
 * @package     <%=data.componentName%>
 * @subpackage  <%=data.modelListName%>
 *
 */

/* @var $this <%=data.names.item.view%> */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task){
		if (task == "<%=data.modelItemName%>.cancel" || document.formvalidator.isValid(document.getElementById("<%=data.modelItemName%>-form")))
		{
			Joomla.submitform(task, document.getElementById("<%=data.modelItemName%>-form"));
		}
	};
');
?>

<form action="<?php echo JRoute::_('index.php?option=com_<%=data.projectName%>&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="<%=data.modelItemName%>-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_<%=s(data.projectName).toUpperCase().value()%>_<%=s(data.modelItemName).toUpperCase().value()%>_DETAILS', true)); ?>
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->getControlGroups('fields'); ?>
			</div>
			<div class="span3">
				<?php //echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
