<div class="staticpages form">
<?php echo $this->Form->create('Staticpage'); ?>
	<fieldset>
		<legend><?php echo __('Add Staticpage'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Staticpages'), array('action' => 'index')); ?></li>
	</ul>
</div>
