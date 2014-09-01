<?php

$this->viewVars['title_for_layout'] = __d('croogo', 'Audits');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Audits'), array('action' => 'index'));

$this->set('showActions', false);

$this->append('table-heading');

	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id'),
		$this->Paginator->sort('event'),
		$this->Paginator->sort('model'),
		$this->Paginator->sort('entity_id'),
		Inflector::humanize('json_object'),
		$this->Paginator->sort('source_id', __d('audit', 'Username')),
		$this->Paginator->sort('created'),
		__d('croogo', 'Actions'),
	));
		echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');
foreach ($audits as $audit): ?>
	<tr>
		<td><?php echo h($audit['Audit']['id']); ?>&nbsp;</td>
		<td><?php echo h($audit['Audit']['event']); ?>&nbsp;</td>
		<td><?php echo h($audit['Audit']['model']); ?>&nbsp;</td>
		<td><?php echo h($audit['Audit']['entity_id']); ?>&nbsp;</td>
		<td>
			<?php
				echo $this->Html->link(__d('croogo', 'View'), '#', array(
					'button' => array('json-view'),
					'icon' => array('large', 'eye-open'),
					'data-target' => '#json-modal',
					'data-title' => $audit['Audit']['model'] . ' ' . $audit['Audit']['entity_id'],
					'data-content' => h(CroogoJson::stringify(json_decode($audit['Audit']['json_object']))),
				));
			?>
			&nbsp;
		</td>
		<td>
		<?php
			if (isset($audit['User']['username'])):
				echo $this->Html->link($audit['User']['username'], array(
					'plugin' => 'users',
					'controller' => 'users',
					'action' => 'index',
					'?' => array(
						'id' => $audit['User']['id'],
					),
				), array(
					'data-title' => __d('audit', 'User: %s', $audit['User']['username']),
					'class' => 'ajax-dialog',
				));
			else:
				echo h($audit['Audit']['source_id']);
			endif;
		?>&nbsp;
		</td>
		<td><?php echo h($audit['Audit']['created']); ?>&nbsp;</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $audit['Audit']['id']), array('icon' => 'eye-open')); ?>
			<?php
				if ($audit['Audit']['event'] === 'EDIT'):
					echo $this->Croogo->adminRowAction('', array(
						'admin' => true,
						'plugin' => 'audit',
						'controller' => 'audit_deltas',
						'action' => 'index',
						'?' => array(
							'audit_id' => $audit['Audit']['id'],
						),
					), array(
						'data-title' => 'Audit Record ' . $audit['Audit']['id'],
						'class' => 'ajax-dialog',
						'icon' => 'folder-open',
					));
				endif;
				?>
		</td>
	</tr>
<?php endforeach; ?>
<?php
$this->end();

$script = <<<EOF
$(".btn-json-view").on("click", function() {
	var el= \$(this)
	var modal = \$('#json-modal');
	$('#json-modal')
		.find('.modal-header h3').html(el.data("title")).end()
		.find('.modal-body').html('<pre>' + el.data('content') + '</pre>').end()
		.modal('toggle');
});
$('.ajax-dialog').on('click', function() {
	var el= \$(this)
	var modal = \$('#json-modal');
	$.get(this.attributes['href'].value, null, function(data, textStatus, xhr) {
		$('#json-modal')
			.find('.modal-header h3').html(el.data("title")).end()
			.find('.modal-body').html(data).end()
			.modal('toggle');
	});
	return false;
});
EOF;
$this->Js->buffer($script);

$this->append('page-footer', $this->element('admin/modal', array(
	'id' => 'json-modal',
	'class' => 'hide',
)));
