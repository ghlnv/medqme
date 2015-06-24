<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array(
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'usuarios',
				'action' => 'login',
			),
			'loginRedirect' => '/',
			'logoutRedirect' => '/usuarios/login',
			'authorize' => 'Controller',
			'authError' => 'Você não tem permissão para acessar este conteúdo',
			'ajaxLogin' => 'ajax_login',
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Usuario',
					'fields' => array(
						'username' => 'login',
						'password' => 'senha',
					)
				)
			),
		),
		'Session',
		'Role',
		'RequestHandler',
//		'DebugKit.Toolbar',
//		'Captcha',
	);
	public $helpers = array(
		'Html',
		'Form',
		'Js',
		'Session',
//		'Util',
//		'Gerar',
	);
	
	public function isAuthorized($user = null) {
		if (isset($this->request->params['admin'])) {
			return $this->Role->isAdmin();
		}
		else if (isset($this->request->params['atendente'])) {
			return $this->Role->isAtendente();
		}
		else if (isset($this->request->params['recepcionista'])) {
			return $this->Role->isRecepcionista();
		}
		else if (isset($this->request->params['saude'])) {
			return $this->Role->isSaude();
		}
		else if (isset($this->request->params['saudebasica'])) {
			return $this->Role->isSaudeBasica();
		}
		else if (isset($this->request->params['gerente'])) {
			return $this->Role->isGerente();
		}
		else if (isset($this->request->params['medico'])) {
			return $this->Role->isMedico();
		}
		return true;
	}
}
