<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Audit Deltas');
$this->extend('/Common/admin_index');

if (!$this->request->is('ajax')):
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Audits'), array('controller' => 'audits', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Audit Deltas'), array('action' => 'index'));
endif;

$this->set('showActions', false);

?>
<?php $this->end('actions'); ?>

<div class="auditDeltas index">
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('property_name', __('Property')); ?></th>
		<th><?php echo $this->Paginator->sort('old_value'); ?></th>
		<th><?php echo $this->Paginator->sort('new_value'); ?></th>
	</tr>
	<?php foreach ($auditDeltas as $auditDelta): ?>
	<tr>
		<td>
		<?php
			echo $this->Html->link('', '#', array(
				'icon' => 'info-sign',
				'class' => 'popovers',
				'data-title' => __('Audit Delta Id'),
				'data-trigger' => 'click',
				'data-placement' => 'right',
				'data-content' => h($auditDelta['AuditDelta']['id']),
			));
		?>&nbsp;
		</td>
		<td><?php echo h($auditDelta['AuditDelta']['property_name']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['old_value']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['new_value']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<style>
.popover {
	width: 300px;
}
</style>
<script>
$(function() {
	$('.popovers').popover().on('click', function() { return false; });
});
</script>
