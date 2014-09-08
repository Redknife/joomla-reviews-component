<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_reviews
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'order.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_reviews&view=review&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-vertical">
<div class="span8 form-vertical">

	<fieldset>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_REVIEWS_REVIEW_DETAILS');?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="details">
              
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('fio'); ?>
					</div>
                    
					<div class="controls">
						<?php echo $this->form->getInput('fio'); ?>
					</div>
				</div>
				
                <div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('date'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('date'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('organization'); ?>
					</div>
                    
					<div class="controls">
						<?php echo $this->form->getInput('organization'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('rate'); ?>
					</div>
                    
					<div class="controls">
						<?php echo $this->form->getInput('rate'); ?>
					</div>
				</div>
                
                <div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('text'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('text'); ?>
					</div>
				</div>
                
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('state'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('state'); ?>
					</div>
				</div>
				
				<div class="clearfix">
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('id'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('id'); ?>
					</div>
				</div>
			</div>
		</div>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
