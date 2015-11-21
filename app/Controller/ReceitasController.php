<?php
App::uses('AppController', 'Controller');

/**
 * CakePHP ReceitasController
 * @author dudow
 */
class ReceitasController extends AppController {

	// #########################################################################
	// Ações públicas ##########################################################
	public function cadastrar() {
		if($this->Receita->cadastrar([
			'pessoa_id' => AuthComponent::user('pessoa_id'),
			'inicio' => date('Y-m-d'),
			'termino' => date('Y-m-d', strtotime('now +1 week')),
		])) {
			$this->redirect([
				'action' => 'wizard',
				$this->Receita->getLastInsertID(),
			]);
		}
		$this->Session->setFlash(__('Sua receita NÃO pode ser cadastrada, por favor tente novamente.', true));
		$this->redirect($this->referer());
	}
	public function wizard($receitaId, $passo = 1) {
		$this->verificarPessoa($receitaId);
		$this->loadModel('Medicamento');
		if(!empty($this->request->is('put'))) {
			if(!$this->Receita->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Receita NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		$this->request->data = $this->Receita->buscar($receitaId);
		
		$dosagens = [];
		$medicamentos = [];
		
		switch ($passo) {
			case 2:
				$dosagens = $this->Medicamento->listarDosagens($this->request->data['Receita']['nome']);
				if(empty($dosagens)) {
					$this->Session->setFlash(__('Dosagens não encontradas, por favor tente outro nome de medicamento...', true));
					$this->redirect([$receitaId, 1]);
				}
			break;
			case 3:
				$medicamentos = $this->Medicamento->listarPorNomeEDosagem(
					$this->request->data['Receita']['nome'],
					$this->request->data['Receita']['dosagem']
				);
				if(empty($medicamentos)) {
					$this->Session->setFlash(__('Medicamentos não encontrados, por favor tente outro nome de medicamento...', true));
					$this->redirect([$receitaId, 1]);
				}
			break;
		}
		$this->set([
			'passo' => $passo,
			'dosagens' => $dosagens,
			'medicamentos' => $medicamentos,
		]);
	}
	public function salvar() {
		if(!empty($this->request->is('put'))) {
			$this->verificarPessoa($this->request->data['Receita']['id']);
			if($this->Receita->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Receita cadastrada com sucesso!', true), 'flash/success');
				$this->redirect([
					'action' => 'index',
				]);
			}
			else {
				$this->Session->setFlash(__('Receita NÃO cadastrada. Verifique os erros no formulário.', true));
			}
		}
		$this->redirect($this->referer());
	}
	public function excluir($id) {
		$this->verificarPessoa($id);
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para a receita', true));
		}
		else {
			if ($this->Receita->delete($id, true)) {
				$this->Session->setFlash(__('Receita excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function index() {
		$this->Paginator->settings['conditions']['Receita.pessoa_id'] = AuthComponent::user('pessoa_id');
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->Paginator->settings['conditions'][]['OR'] = ['Receita.nome LIKE' => "%$token%"];
			}
		}
		$this->Paginator->settings['contain'] = ['Medicamento'];
		$this->set([
			'receitas' => $this->Paginator->paginate('Receita'),
		]);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function verificarPessoa($id) {
		if(AuthComponent::user('pessoa_id') != $this->Receita->field('pessoa_id', ['id' => $id])) {
			$this->Session->setFlash(__('Id inválido para a receita', true));
			$this->redirect($this->referer());
		}
	}
}
