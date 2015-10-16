<?php
class PessoasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function formRegistro() {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['class' => 'container']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-8']);
		$ret.= $this->Html->tag('h2', 'Registre-se!');
		$ret.= $this->Html->tag('hr');
		$ret.= $this->Form->create('Pessoa', array(
			'url' => [
				'controller' => 'pessoas',
				'action' => 'registrar',
			],
		));
		$ret.= $this->Form->hidden('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome',
		));
		$ret.= $this->Form->input('Pessoa.email', array(
			'div' => array('style' => ''),
		));
		$ret.= $this->Form->submit('Registrar');
		$ret.= $this->Form->end();
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function formEditarLoginSenha() {
		$ret = '';
		$ret.= $this->Form->create('Usuario', array(
			'url' => array(
				'controller' => 'pessoas',
			),
			'class' => 'cakeForm centralizarComTamanhoMaximo',
			'style' => 'padding: 0 2em;',
		));
		$ret.= $this->Form->input('id');
		$ret.= $this->Form->hidden('Usuario.pessoa_id');

		$ret.= $this->Html->tag('div', null, array('style' => 'float: left; margin: 0 1em 0 0; padding: 0;'));
		$ret.= $this->Form->input('Usuario.login', array(
			'div' => [
				'class' => 'input text form-group auto',
			],
			'label' => 'Login',
			'class' => 'form-control',
			'style' => 'width: 200px;',
			'readonly' => true,
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->input('senha_atual', array(
			'div' => [
				'class' => 'input text form-group auto',
			],
			'label'=> 'Senha atual',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
			'style' => 'width: 200px;',
		));
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, array('style' => 'float: left; margin: 0; padding: 0;'));
		$ret.= $this->Form->input('nova_senha', array(
			'div' => [
				'class' => 'input text form-group auto',
			],
			'label'=> 'Nova senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
			'style' => 'width: 200px;',
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->input('confirm', array(
			'div' => [
				'class' => 'input text form-group auto',
			],
			'label'=> 'Confirme a nova senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
			'style' => 'width: 200px;',
		));
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'style' => 'clear: both; float: left; margin-top: 0;',
			),
		));
		$ret.= $this->Html->tag('div', '', array('class' => 'clear'));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formEditarLoginSenhaAdmin() {
		$ret = '';
		$ret.= $this->Form->create('Usuario', array(
			'url' => array(
				'controller' => 'pessoas',
			),
			'class' => 'cakeForm centralizarComTamanhoMaximo',
			'style' => 'max-width: 300px; padding: 0 2em;',
		));
		$ret.= $this->Form->input('id');
		$ret.= $this->Form->input('Usuario.login', array(
			'div' => [
				'class' => 'input text form-group',
			],
			'label' => 'Login',
			'class' => 'form-control',
			'readonly' => true,
		));
		$ret.= $this->Form->input('nova_senha', array(
			'div' => [
				'class' => 'input text form-group',
			],
			'label'=> 'Nova Senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
		));
		$ret.= $this->Form->input('confirm', array(
			'div' => [
				'class' => 'input text form-group',
			],
			'label'=> 'Confirme a nova senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
		));
		$ret.= $this->Form->submit('Salvar');
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formPerfil() {
		$ret = '';
		$ret.= $this->Form->create('Pessoa', array(
			'url' => array(
				'controller' => 'pessoas',
			),
			'class' => 'centralizarComTamanhoMaximo',
			'style' => 'max-width: 800px; padding: 0 2em;',
		));

		$ret.= $this->Form->input('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.nome', array(
			'div' => ['class' => 'input required auto'],
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Pessoa.email', array(
			'div' => [
				'class' => 'input required auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'label' => 'E-mail',
			'class' => 'form-control',
			'style' => 'width: 300px;'
		));
		$ret.= $this->Form->input('Pessoa.telefone', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control phone',
			'style' => 'text-align: center;',
		));
		$ret.= $this->Form->input('Pessoa.telefone_alternativo', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control phone',
			'style' => 'text-align: center;',
		));
		$ret.= $this->Form->input('Pessoa.nascimento', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'type' => 'text',
			'class' => 'form-control birth date',
			'value' => $this->Gerar->brDate($this->request->data['Pessoa']['nascimento']),
		));
		$ret.= $this->Html->tag('br');

		$ret.= $this->Form->input('Pessoa.logradouro', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 13em;',
		));
		$ret.= $this->Form->input('Pessoa.numero', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'label' => 'Nro.',
			'class' => 'form-control',
			'style' => 'width: 6em;',
		));
		$ret.= $this->Form->input('Pessoa.complemento', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 10em;',
		));
		$ret.= $this->Form->input('Pessoa.bairro', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 10em;',
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->input('Pessoa.cidade', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 12em;',
		));
		$ret.= $this->Form->input('Pessoa.estado', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block;'
			],
			'class' => 'form-control',
			'style' => 'width: 4em; text-align: center;'
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'style' => 'clear: both;',
			),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formBuscaPadrao() {
		$ret = '';
		$ret.= $this->Form->create('Filtro', array(
			'url' => [
				'controller' => $this->request->params['controller'],
			],
			'class' => 'form-inline',
			'style' => 'margin-bottom: 10px; padding: 10px;',
		));
		$ret.= $this->Form->input('Filtro.keywords', array(
			'div' => [
				'class' => 'form-group col-md-4',
				'style' => 'display: inline-block; float: none; padding: 0 5px 0 0; min-width: 200px;',
			],
			'label' => false,
			'placeholder' => 'Palavras-chaves...',
			'title' => 'Palavras-chaves...',
			'class' => 'form-control',
			'style' => 'width: 100%',
		));
		$ret.= $this->Form->submit('Buscar', array(
			'div' => [
				'class' => 'form-group col-md-2',
				'style' => 'display: inline-block; float: none; padding: 0;',
			],
			'class' => 'btn btn-default',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function linkParaExcluir(&$pessoa) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
			array(
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'excluir',
				$pessoa['id'],
			),
			array(
				'title' => 'Excluir pessoa',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir esta pessoa?',
				'escape' => false
			)
		);
	}
	public function linkParaEditar(&$pessoa) {
		return $this->Html->link($this->Html->image('icons/edit-32.png'),
			array(
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'editar',
				$pessoa['id'],
			),
			array(
				'title' => 'Editar pessoa',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkCurriculo(&$pessoa) {
		return $this->Html->link($this->Html->image('icons/cv-32.png'),
			array(
				'admin' => false,
				'controller' => 'pessoas',
				'action' => 'curriculo',
				$pessoa['id'],
				Inflector::slug($pessoa['nome'], '-'),
			),
			array(
				'title' => 'Ver perfil da pessoa',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkVoltarParaPessoas() {
		return $this->Html->link("&#10096;",
			array(
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'index',
			),
			array(
				'class' => 'navLinks',
				'title' => 'Voltar para gerenciar pessoas',
				'style' => '',
				'escape' => false
			)
		);
	}
	public function idade($nascimento) {
		$date = new DateTime( date('Y-m-d', strtotime($nascimento)) ); // data de nascimento
		$interval = $date->diff( new DateTime() ); // data definida
		$anos = $interval->format('%y');
		$meses = $interval->format('%m');
		$dias = $interval->format('%d');
		
		$ret = '';
		if($anos) {
			if(1 == $anos) {
				$ret.= '1 ano';
			}
			else {
				$ret.= "$anos anos";
			}
		}
		if($meses) {
			if($anos) {
				$ret.= ' e ';
			}
			if(1 == $meses) {
				$ret.= '1 mês';
			}
			else {
				$ret.= "$meses meses";
			}
		}
		if(!$anos && $dias) {
			if($meses) {
				$ret.= ' e ';
			}
			if(1 == $dias) {
				$ret.= '1 dia';
			}
			else {
				$ret.= "$dias dias";
			}
		}
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}