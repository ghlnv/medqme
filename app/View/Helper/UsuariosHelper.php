<?php
class UsuariosHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function linkParaEsqueciMinhaSenha() {
		$this->Js->buffer("loadDlgEsqueciMinhaSenha();");
		
		$linkTxt = null;
		$linkTxt.= $this->Html->image('icons/help.png', array('style' => 'margin-right: 5px;'));
		$linkTxt.= ' esqueci minha senha';
		return $this->Html->link($linkTxt,
			array(
				'aluno' => false,
				'controller' => 'usuarios',
				'action' => 'esqueciMinhaSenha',
			),
			array(
				'class' => 'dlgEsqueciMinhaSenha clean',
				'title' => 'Esqueci minha senha',
				'style' => 'float: left; margin: 0 0 0 0.5em;',
				'escape' => false,
			)
		);
	}

	// #########################################################################
	// Métodos privados ########################################################
}