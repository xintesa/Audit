<?php
$this->set('title_for_layout', sprintf('%s: %s', __d('croogo', 'Audits'), h($audit['Audit']['id'])));

$this->set('displayFields', array());

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Audits'), array('action' => 'index'));

$this->append('actions');
	echo $this->Html->link(__d('croogo', 'List Audits'), array('action' => 'index'), array('button' => 'default'));
$this->end();

$this->append('table-body');
?>
<div class="audits view">
	<dl class="inline">
		<dt><?php echo __d('croogo', 'Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Event'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['event']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Model'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Entity Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['entity_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Json Object'); ?></dt>
		<dd>
			<?php
				echo $this->Html->link(__d('croogo', 'View'), '#', array(
					'button' => array('json-view'),
					'icon' => array('large', 'read'),
					'data-target' => '#json-modal',
					'data-title' => $audit['Audit']['model'] . ' ' . $audit['Audit']['entity_id'],
					'data-content' => h(CroogoJson::stringify(json_decode($audit['Audit']['json_object']))),
				));
			?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Description'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Source Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['source_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Created'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['created']); ?>
			&nbsp;
		</dd>
	</dl>

<?php if (!empty($audit['AuditDelta'])): ?>
	<div class="audit-deltas span12">
		<h4>Deltas</h4>
	<?php foreach ($audit['AuditDelta'] as $delta): ?>
		<hr />

		<dl>

			<dt><?php echo __d('croogo', 'Id'); ?></dt>
			<dd>
				<?php echo h($delta['id']); ?>
				&nbsp;
			</dd>

			<dt><?php echo __d('croogo', 'Property Name'); ?></dt>
			<dd>
				<?php echo h($delta['property_name']); ?>
				&nbsp;
			</dd>

			<dt><?php echo __d('croogo', 'Old Value'); ?></dt>
			<dd>
				<pre><?php echo h($delta['old_value']); ?></pre>
			</dd>

			<dt><?php echo __d('croogo', 'New Value'); ?></dt>
			<dd>
				<pre><?php echo h($delta['new_value']); ?></pre>
			</dd>

		</dl>
	<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php
$this->end();

$script = <<<EOF
$(".btn-json-view").on("click", function() {
	console.log('here');
	var el= \$(this)
	var modal = \$('#json-modal');
	$('#json-modal')
		.find('.modal-header h3').html(el.data("title")).end()
		.find('.modal-body').html('<pre>' + el.data('content') + '</pre>').end()
		.modal('toggle');
});
EOF;
$this->Js->buffer($script);

$this->append('page-footer');
echo $this->element('admin/modal', array(
	'id' => 'json-modal',
	'class' => 'hide',
));
$this->end();
