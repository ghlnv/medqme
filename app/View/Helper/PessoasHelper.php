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
		$ret.= $this->Form->hidden('Usuario.id');
		$ret.= $this->Form->input('Usuario.tipo', array(
			'div' => array('style' => ''),
			'type' => 'radio',
			'legend' => false,
			'options' => Configure::read('Usuario.tipos'),
			'default' => 'Comum',
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Pessoa.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome',
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Pessoa.email', array(
			'div' => array('style' => ''),
			'class' => 'form-control',
		));
		$ret.= $this->Html->tag('div', null, [
			'class' => 'row input',
		]);
		$ret.= $this->Form->input('Pessoa.cidade', array(
			'div' => array('class' => 'col-md-6'),
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Pessoa.estado', array(
			'div' => array('class' => 'col-md-2'),
			'class' => 'form-control',
		));
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Form->submit('Registrar', [
			'div' => ['class' => 'input auto'],
			'class' => 'btn btn-primary',
		]);
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
				'class' => 'input submit',
				'style' => 'clear: both; float: left; margin-top: 0;',
			),
			'class' => 'btn btn-primary',
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
			'label' => 'Login',
			'class' => 'form-control',
			'readonly' => true,
		));
		$ret.= $this->Form->input('nova_senha', array(
			'label'=> 'Nova Senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
		));
		$ret.= $this->Form->input('confirm', array(
			'label'=> 'Confirme a nova senha',
			'type' => 'password',
			'size' => 20,
			'class' => 'form-control empty',
		));
		$ret.= $this->Form->submit('Salvar', [
			'class' => 'btn btn-primary',
		]);
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
		$ret.= $this->formInputsNomeEmail();
		$ret.= $this->Html->tag('br');
		$ret.= $this->formInputsTelefones();
		$ret.= $this->Form->input('Pessoa.nascimento', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'type' => 'text',
			'class' => 'form-control birth date',
			'value' => $this->Gerar->brDate($this->request->data['Pessoa']['nascimento'], 'd-m-Y'),
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->formInputsEndereco();
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'class' => 'input submit',
				'style' => 'clear: both;',
			),
			'class' => 'btn btn-primary',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formPerfilEstudante() {
		$ret = '';
		$ret.= $this->Form->create('Pessoa', array(
			'url' => array(
				'controller' => 'pessoas',
			),
			'class' => 'centralizarComTamanhoMaximo',
			'style' => 'max-width: 800px; padding: 0 2em;',
		));

		$ret.= $this->Form->input('Pessoa.id');
		$ret.= $this->formInputsNomeEmail();

		$ret.= $this->Html->tag('h4', 'Ensino superior', ['style' => 'margin: 20px 5px 10px;']);
		$ret.= $this->Form->input('Pessoa.escolaridade', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Escolaridade',
			'options' => Configure::read('Estudante.escolaridades'),
		));
		$ret.= $this->Form->input('Pessoa.escolaridade_ano', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Ano ingresso',
			'style' => 'width: 80px; text-align: center;',
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->input('Pessoa.instituicao', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Instituição de ensino',
		));
		$ret.= $this->Form->input('Pessoa.instituicao_cidade', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Cidade',
		));
		$ret.= $this->Form->input('Pessoa.instituicao_estado', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Estado',
			'style' => 'width: 80px; text-align: center;',
		));
		$ret.= $this->Html->tag('h4', 'Dados pessoais', ['style' => 'margin: 20px 5px 10px;']);
		$ret.= $this->formInputsTelefones();
		$ret.= $this->Form->input('Pessoa.nascimento', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'type' => 'text',
			'class' => 'form-control birth date',
			'value' => $this->Gerar->brDate($this->request->data['Pessoa']['nascimento'], 'd-m-Y'),
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->formInputsEndereco();
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'class' => 'input submit',
				'style' => 'clear: both;',
			),
			'class' => 'btn btn-primary',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formPerfilSaude() {
		$ret = '';
		$ret.= $this->Form->create('Pessoa', array(
			'url' => array(
				'controller' => 'pessoas',
			),
			'class' => 'centralizarComTamanhoMaximo',
			'style' => 'max-width: 800px; padding: 0 2em;',
		));

		$ret.= $this->Form->input('Pessoa.id');
		$ret.= $this->formInputsNomeEmail();

		$ret.= $this->Html->tag('h4', 'Profissional de saúde', ['style' => 'margin: 20px 5px 10px;']);
		$ret.= $this->Form->input('Pessoa.especialidade', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'Especialidade',
		));
		$ret.= $this->Form->input('Pessoa.cr', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'label' => 'CRM',
			'style' => 'width: 150px; text-align: center;',
		));
		$ret.= $this->Html->tag('h4', 'Dados pessoais', ['style' => 'margin: 20px 5px 10px;']);
		$ret.= $this->formInputsTelefones();
		$ret.= $this->Form->input('Pessoa.nascimento', array(
			'div' => [
				'class' => 'input auto',
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'type' => 'text',
			'class' => 'form-control birth date',
			'value' => $this->Gerar->brDate($this->request->data['Pessoa']['nascimento'], 'd-m-Y'),
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->formInputsEndereco();
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'class' => 'input submit',
				'style' => 'clear: both;',
			),
			'class' => 'btn btn-primary',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formInputsNomeEmail() {
		$ret = '';
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
		return $ret;
	}
	public function formInputsTelefones() {
		$ret = '';
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
		return $ret;
	}
	public function formInputsEndereco() {
		$ret = '';
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