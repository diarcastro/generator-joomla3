<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.<%=data.templateName%>
 *
 * @copyright
 * @license
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

?>
<div id="system-message-container">
	<?php if (is_array($msgList) && $msgList) : ?>
		<dl id="system-message">
			<?php foreach ($msgList as $type => $msgs) : ?>
				<?php if ($msgs) : ?>
					<dt class="<?php echo strtolower($type); ?>"><?php echo JText::_($type); ?></dt>
					<dd class="<?php echo strtolower($type); ?> message">
						<ul>
							<?php foreach ($msgs as $msg) : ?>
								<li><?php echo $msg; ?></li>
							<?php endforeach; ?>
						</ul>
					</dd>
				<?php endif; ?>
			<?php endforeach; ?>
		</dl>
	<?php endif; ?>
</div>
