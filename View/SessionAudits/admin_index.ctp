<?php
$this->viewVars['title_for_layout'] = __d('croogo', 'Session Audits');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Session Audits'), array('action' => 'index'));

?>
<?php $this->start('actions'); ?>
&nbsp;
<?php $this->end('actions'); ?>

	<table class="table table-striped">
<?php
$this->append('table-heading');

	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id') . '<br />' .
		$this->Paginator->sort('session_id') . '<br />' .
		$this->Paginator->sort('event') . '</th>',

		$this->Paginator->sort('user_id'),
		$this->Paginator->sort('source_id'),
		$this->Paginator->sort('remote_addr'),

		$this->Paginator->sort('ua') . '<br />' .
		$this->Paginator->sort('referer') . '<br />' .
		$this->Paginator->sort('created') . '<th>' . '</th>'
	));
	echo $this->Html->tag('thead', $tableHeaders);
$this->end();
echo __d('croogo', 'Actions');?>

<?php
foreach ($sessionAudits as $sessionAudit): ?>
	<tr>
		<td>
			<?php echo h($sessionAudit['SessionAudit']['id']); ?>&nbsp;<br />
			<?php echo h($sessionAudit['SessionAudit']['session_id']); ?>&nbsp;<br />
			<?php echo h($sessionAudit['SessionAudit']['event']); ?>&nbsp;
		</td>
		<td>
			<?php
				echo $this->Html->link($sessionAudit['User']['name'], array(
					'plugin' => 'users', 'controller' => 'users', 'action' => 'view',
					$sessionAudit['User']['id']
				));
			?>
		</td>
		<td>
			<?php
				echo $this->Html->link($sessionAudit['Source']['name'], array(
					'plugin' => 'users', 'controller' => 'users', 'action' => 'view',
					$sessionAudit['Source']['id'],
				));
			?>
		</td>
		<td><?php echo h($sessionAudit['SessionAudit']['remote_addr']); ?>&nbsp;</td>
		<td>
			<?php
			list($ua,)= explode(' ', $sessionAudit['SessionAudit']['ua']);
			echo $this->Html->tag('span', $ua, array(
				'title' => $sessionAudit['SessionAudit']['ua'],
			));
			?>&nbsp;</br>
			<?php echo h($sessionAudit['SessionAudit']['referer']); ?>&nbsp;<br />
			<?php echo h($sessionAudit['SessionAudit']['created']); ?>&nbsp;
		</td>
		<td class="item-actions">
			<?php echo $this->Croogo->adminRowAction('', array('action' => 'view', $sessionAudit['SessionAudit']['id']), array('icon' => 'eye-open')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
