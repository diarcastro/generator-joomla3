<?php

	defined('_JEXEC') or die();
	/* @var $this JDocumentHtml */

	$app             = JFactory::getApplication();
	$doc             = JFactory::getDocument();
	$user            = JFactory::getUser();

	// Getting params from template
	$params = $app->getTemplate(true)->params;

	// Detecting Active Variables
	$option   = $app->input->getCmd('option', '');
	$view     = $app->input->getCmd('view', '');
	$layout   = $app->input->getCmd('layout', '');
	$task     = $app->input->getCmd('task', '');
	$itemid   = $app->input->getCmd('Itemid', '');
	$sitename = $app->get('sitename');

	$this->setGenerator('');
	// Add JavaScript Frameworks
	//JHtml::_('bootstrap.framework');

	$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');
?>
<!DOCTYPE html>
<html>
<head>
	<jdoc:include type="head" />
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<header>
		<!-- Header Section-->
	</header>
	<section>
		<section class="container">
			<jdoc:include type="message" />
			<jdoc:include type="component" />
		</section>
	</section>
	<footer>
		<!-- Footer Section-->
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>