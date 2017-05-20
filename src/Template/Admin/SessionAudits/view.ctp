<?php
$this->viewVars['title_for_layout'] = sprintf('%s: %s', __d('croogo', 'Session Audits'), h($sessionAudit['SessionAudit']['id']));

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Session Audits'), array('action' => 'index'))
	->addCrumb($this->request->params['pass'][0], $this->here);

$this->extend('/Common/admin_index');

?>
<h2 class="hidden-desktop"><?php echo __d('croogo', 'Session Audit'); ?></h2>

<?php
$this->start('actions');
	echo $this->Croogo->adminAction(__d('croogo', 'Session Audits'), array('action' => 'index'), array('button' => 'default'));
$this->end();
?>

<div class="sessionAudits view">
	<dl class="inline">
		<dt><?php echo __d('croogo', 'Id'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Event'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['event']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'User'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Source'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['Source']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Host'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['host']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Ua'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['ua']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Referer'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['referer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Server Name'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['server_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Server Address'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['server_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Server Port'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['server_port']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Remote Addr'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['remote_addr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Request Scheme'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['request_scheme']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Request Time'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['request_time']); ?>
			&nbsp;
		</dd>

<?php if (false): ?>
		<dt><?php echo __d('croogo', 'Request Time Float'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['request_time_float']); ?>
			&nbsp;
		</dd>
<?php endif; ?>

		<dt><?php echo __d('croogo', 'Description'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Session Id'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['session_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('croogo', 'Created'); ?></dt>
		<dd>
			<?php echo h($sessionAudit['SessionAudit']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
