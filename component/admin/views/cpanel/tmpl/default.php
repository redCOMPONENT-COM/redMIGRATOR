<?php
/**
 * @package     redMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

// No direct access.
defined('_JEXEC') or die;

RHelperAsset::load('lib/font-awesome/css/font-awesome.min.css', 'redcore');

// Get the version
$version = "v{$this->version}";
// get params
$params	= $this->params;
// get document to add scripts
$document	= JFactory::getDocument();
$document->addScript('components/com_redmigrator/js/dwProgressBar.js');
$document->addScript("components/com_redmigrator/js/migrate.js");
$document->addScript('components/com_redmigrator/js/requestmultiple.js');
$document->addStyleSheet("components/com_redmigrator/css/redmigrator.css");
?>
<script type="text/javascript">

window.addEvent('domready', function() {

	/* Init redmigrator */
	var redMigrator = new redmigrator({
		method: '<?php echo $params->method ? $params->method : 0; ?>',
		positions: <?php echo $params->positions ? $params->positions : 0; ?>,
		skip_checks: <?php echo $params->skip_checks ? $params->skip_checks : 0; ?>,
		debug_step: <?php echo $params->debug_step ? $params->debug_step : 0; ?>,
		debug_migrate: <?php echo $params->debug_migrate ? $params->debug_migrate : 0; ?>,
		debug_check: <?php echo $params->debug_check ? $params->debug_check : 0; ?>,
	});

});

</script>

<table width="100%">
	<tbody>
		<tr>
			<td width="100%" valign="top" align="center">

				<div id="error" class="error"></div>

				<div id="warning" class="warning">
					<?php echo JText::_('COM_REDMIGRATOR_WARNING_SLOW'); ?>
				</div>

				<div id="update">
					<br /><img src="components/com_redmigrator/images/update.png" align="middle" border="0"/><br />
					<h2><?php echo JText::_('START UPGRADE'); ?></h2><br />
				</div>

				<div id="checks">
					<p class="text"><?php echo JText::_('Checking and cleaning...'); ?></p>
					<div id="pb0"></div>
					<div><small><i><span id="checkstatus"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
				</div>

				<div id="migration">
					<p class="text"><?php echo JText::_('Upgrading progress...'); ?></p>
					<div id="pb4"></div>
					<div><small><i><span id="migrate_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="counter">
						<i><small><b><span id="currItem">0</span></b> items /
						<b><span id="totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="files">
					<p class="text"><?php echo JText::_('Copying images/media files...'); ?></p>
					<div id="pb5"></div>
					<div><small><i><span id="files_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="files_counter">
						<i><small><b><span id="files_currItem">0</span></b> items /
						<b><span id="files_totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="templates">
					<p class="text"><?php echo JText::_('Copying templates...'); ?></p>
					<div id="pb6"></div>
				</div>

				<div id="extensions">
					<p class="text"><?php echo JText::_('Upgrading 3rd extensions...'); ?></p>
					<div id="pb7"></div>
					<div><small><i><span id="ext_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="ext_counter">
						<i><small><b><span id="ext_currItem">0</span></b> items /
						<b><span id="ext_totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="done">
					<h2 class="done"><?php echo JText::_('Migration Successful!'); ?></h2>
				</div>

				<div id="info">
					<div id="info_version"><i><?php echo JText::_('redmigrator'); ?></i> <?php echo JText::_('Version').' <b>'.$this->version.'</b>'; ?></div>
					<div id="info_thanks">
						<p>
							<?php echo JText::_('Developed by'); ?> <i><a href="http://www.redcomponent.com/">redCOMPONENT &#169;</a></i>  Copyright 2005-2013<br />
							Licensed as <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html"><i>GNU General Public License v2</i></a><br />
						</p>
						<h3>							
							<a href="http://wiki.redcomponent.com/index.php?title=RedMIGRATOR:Table_of_Contents">Wiki</a><br />
						</h3>
					</div>
				</div>

				<div>
					<div id="debug"></div>
				</div>

			</td>
		</tr>
	</tbody>
</table>

<form action="index.php?option=com_redmigrator" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_redmigrator" />
	<input type="hidden" name="task" value="" />
</form>
