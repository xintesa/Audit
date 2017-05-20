<?php


class AuditEventHandler implements EventListener {

	protected $_events = array(
		'Controller.Users.loginSuccessful',
		'Controller.Users.loginFailure',
		'Controller.Users.afterLogout',
		'Controller.Users.adminLoginSuccessful',
		'Controller.Users.adminLoginFailure',
		'Controller.Users.adminLogoutSuccessful',
	);

	public function implementedEvents() {
		$loginEvents = array_fill_keys($this->_events, array(
			'callable' => 'onLoginEvents',
		));
		return $loginEvents;
	}

	protected function _guessUserId($controller) {
		if (empty($controller->request->data)) {
			return -1;
		}
		$request = $controller->request;
		$modelClass = $controller->modelClass;
		$model = $controller->{$modelClass};
		$usernameFields = array('username' => null, 'email' => null);

		if ($model) {
			$usernameField = key(array_intersect_key(
				$usernameFields,
				$request->data[$model->alias]
			));
			$username = $request->data[$model->alias][$usernameField];
			$userId = $model->field('id', array($usernameField => $username));
			if ($userId) {
				return $userId;
			}
			return $username;
		}
		return -1;
	}

	public function onLoginEvents($event) {
		$safe = Configure::read('Audit.trustHttpForwardedFor');
		if ($safe === null) {
			$safe = false;
		}
		$controller = $event->subject;

		$user_id = $source_id = AuthComponent::user('id');
		if (empty($user_id)) {
			$user_id = $this->_guessUserId($controller);
		}
		$host = env('HTTP_HOST');
		$ua = env('HTTP_USER_AGENT');
		$referer = $controller->request->referer();
		$server_name = env('SERVER_NAME');
		$server_port = env('SERVER_PORT');
		$remote_addr = $controller->request->clientIp($safe);
		$request_scheme = env('REQUEST_SCHEME');
		$request_time = env('REQUEST_TIME');
		$session_id = session_id();

		$audit = compact(
			'user_id', 'source_id', 'host', 'ua', 'referer',
			'server_name', 'server_port', 'remote_addr',
			'request_time', 'request_time_float', 'session_id'
		);
		$audit['event'] = $event->name;

		$SessionAudit = ClassRegistry::init('Audit.SessionAudit');
		$SessionAudit->create();
		$result = $SessionAudit->save(array('SessionAudit' => $audit));
		if (!$result) {
			Log::critical('Unable to log session audit records');
			$event->result = false;
			$event->stopPropagation();
		}
		return $event;
	}

}
