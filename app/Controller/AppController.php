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
			'loginAction' => '/usuarios/login',
			'loginRedirect' => '/',
			'logoutRedirect' => '/usuarios/login',
			'authorize' => 'Controller',
			'authError' => 'Você não tem permissão para acessar este conteúdo',
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
		'DebugKit.Toolbar' => array('panels' => array('history' => false)),
//		'Captcha',
	);
	public $helpers = array(
		'Html',
		'Form',
		'Js',
		'Session',
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function beforeFilter() {
		parent::beforeFilter();
		$this->dataToParam();
		if($this->RequestHandler->isAjax()) {
            if(!$this->Auth->user()) {
				$this->Session->setFlash('Sua sessão expirou, por favor faça novamente o login.', 'default', array(), 'auth');
				
				$url = Router::url('/usuarios/login');
				echo "<script>window.location.href = '$url';</script>";
				die();
            }
        }
	}
	public function beforeRender() {
		parent::beforeRender();
		$this->paramToData();
	}
	public function isAuthorized($user = null) {
		if (isset($this->request->params['admin'])) {
			return $this->Role->isAdmin();
		}
		return true;
	}
	
	public function contentReload() {
		$contentReload = $this->referer();
		$this->set(compact('contentReload'));
	}
	public function windowOpenerReload() {
		echo '<script>';
		//'window.opener.location.href = window.opener.location.href;';
		echo 'window.opener.location.reload( false );';
		echo '</script>';
	}
	public function windowReload() {
		echo '<div style="padding: 20px; text-align: center;">';
		echo 'recarregando...';
		echo '</div>';
		echo '<script>';
		echo 'window.location.reload( false );';
		echo '</script>';
		exit;
	}
	public function windowClose() {
		echo '<div style="padding: 20px; text-align: center;">';
		echo 'fechando...';
		echo '</div>';
		echo '<script>';
		echo 'window.close();';
		echo '</script>';
		exit;
	}
	public function windowRedirect($url) {
		$url = Router::url($url);
		
		echo '<div style="padding: 20px; text-align: center;">';
		echo 'recarregando...';
		echo '</div>';
		echo '<script>';
		echo "window.location.href = '$url';";
		echo '</script>';
		exit;
	}
	public function fecharDialog() {
		$this->set('fecharDialog', true);
	}
	public function setAjaxFlashMessage($text) {
		$this->set('ajaxFlashMessage', $text);
	}
	
	public function retornarParaRota() {
		if($this->Role->isAdmin(AuthComponent::user())) {
			$this->redirect(array(
				'admin' => true,
			));
		}
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function dataToParam() {
		if (!empty($this->request->data['Filtro'])) {
			$url = array();
			foreach($this->request->data['Filtro'] as $filtro => $valor) {
				if(is_array($valor)) {
					$valor = implode(';',$valor);
				}
				else {
					$valor = trim($valor);
				}
				if($valor) {
					$url[$filtro] = $valor;
				}
			}
			if(!empty($this->request->params['pass'])) {
				$url = array_merge($url, $this->request->params['pass']);
			}
			if(!empty($this->request->params['named'])) {
				$url = array_merge($url, $this->request->params['named']);
			}
				
			$this->redirect($url);
		}
	}
	private function paramToData() {
		if (!empty($this->request->params['named'])) {
			$this->request->data['Filtro'] = $this->request->params['named'];
			foreach($this->request->data['Filtro'] as $filtro => $valor) {
				if(strpos($valor, ';')) {
					$this->request->data['Filtro'][$filtro] = explode(';',$valor);
				}
			}
		}
	}
}
