<?php 
class JsonController extends AppController {

	public $uses = ['Usuario'];
	public $mobile = false;

	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow();
		
		$this->paramsNamedToData();
		if(//$this->request->is('post')
		$this->request->data('token')
		&& $this->request->data('hash')) {
			$this->log($this->request->data, 'mobile');
			$this->mobile = $this->Usuario->authenticateMobile(
				$this->request->data('hash'),
				$this->request->data('token')
			);
		}

		$this->set('title_for_layout', 'json');
	}
	
	// #########################################################################
	// Ações públicas ##########################################################
	public function login () {
		$return = false;
//		if($this->request->is('post')) {
			$check = $this->Usuario->checkMobileLogin($this->request->data['username'], $this->request->data['password']);
			if($check) {
				$return['return'] = reset($check);
			}
//		}
		return new CakeResponse(array('body' => json_encode($return, JSON_NUMERIC_CHECK)));
	}
	
	// #########################################################################
	// Ações de usuários #######################################################
	public function getRemediosAtivos() {
		if(!$this->mobile) {
			return new CakeResponse(array('body' => json_encode(false, JSON_NUMERIC_CHECK)));
		}
		$this->loadModel('Receita');
		return new CakeResponse(array('body' => json_encode(
			[
				'Remedios' => $this->Receita->mobileAtivos($this->mobile['Usuario']['pessoa_id'])
			],
			JSON_NUMERIC_CHECK
		)));
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function paramsNamedToData() {
		$this->request->data = $this->request->params['named'];
	}
}