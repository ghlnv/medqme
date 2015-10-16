<?php
class GerarHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Consultas', 'Pacientes'); 

	// #########################################################################
	// Métodos #################################################################
	public function explodeReset($string) {
		$string = explode(' ', $string);
		return reset($string);
	}
	public function playBeep() {
		$ret = '';
		$ret.= $this->Html->tag('audio', null, array(
			'controls' => true,
			'autoplay' => true,
			'style' => 'display: none;',
		));
		$ret.= $this->Html->tag('source', '', array(
			'src' => $this->Html->url('/files/notify.mp3'),
			'type' => 'audio/mpeg',
		));
		$ret.= $this->Html->tag('/audio');
		return $ret;
	}
	public function chatRefresh($time = 10000) {
		$divId = String::uuid();
		$url = $this->Html->url();
		$this->Js->buffer("loadRefreshChat('#$divId', '$url', $time);");
		return $this->Html->tag('div', '', array('id' => $divId));
	}
	public function caixaConsultaSemEditar($consulta) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, array('class' => 'caixa'));
		$ret.= $this->Html->tag('div', null, array('style' => 'float: right; margin: -0.3em 0 0 1em;'));
		$ret.= $this->Consultas->status($consulta);
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, array('style' => 'font-weight: bolder;'));
		$ret.= $this->brDate($consulta['Consulta']['data'], 'd/m/Y H:i');
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div');
		$ret.= $this->Html->tag('b', 'PS: ');
		$ret.= $consulta['Medico']['nome'];
		
		if(!empty($consulta['Sala']['nome'])) {
			$ret.= $this->Html->tag('b');
			$ret.= ' [ ';
			$ret.= $consulta['Sala']['nome'];
			$ret.= ' ] ';
			$ret.= $this->Html->tag('/b');
		}
		
		$ret.= $this->Html->tag('br');
		$ret.= $this->Html->tag('span', null, array('class' => 'nowrap'));
		$ret.= $this->Html->tag('b', 'Convênio: ');
		$ret.= $consulta['Convenio']['nome'];
		$ret.= $this->Html->tag('/span');
		$ret.= $this->Html->tag('/div');

		if(!empty($consulta['Consulta']['descricao'])) {
			$ret.= $this->Html->tag('div');
			$ret.= $this->Html->tag('b', 'Descrição: ');
			$ret.= $consulta['Consulta']['descricao'];
			$ret.= $this->Html->tag('/div');
		}
		$ret.= $this->Html->tag('div', '', array('class' => 'clear'));
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function caixaConsulta($consulta) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, array('class' => 'caixa'));
		$ret.= $this->Html->link($this->Html->image('icones/editar.png'),
			array(
				'controller' => 'consultas',
				'action' => 'editar',
				$consulta['Consulta']['id']
			),
			array(
				'class' => 'dlgEditarPadrao',
				'title' => 'Editar consulta',
				'style' => 'float: right; margin-left: 0.5em;',
				'escape' => false,
			)
		);

		$ret.= $this->Html->tag('div', null, array('style' => 'float: right; margin: -0.3em 0 0 1em;'));
		$ret.= $this->Consultas->status($consulta);
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, array('style' => 'font-weight: bolder;'));
		$ret.= $this->brDate($consulta['Consulta']['data'], 'd/m/Y H:i');
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div');
		$ret.= $this->Html->tag('b', 'PS: ');
		$ret.= $consulta['Medico']['nome'];
		
		if(!empty($consulta['Sala']['nome'])) {
			$ret.= $this->Html->tag('b');
			$ret.= ' [ ';
			$ret.= $consulta['Sala']['nome'];
			$ret.= ' ] ';
			$ret.= $this->Html->tag('/b');
		}
		
		$ret.= $this->Html->tag('br');
		$ret.= $this->Html->tag('span', null, array('class' => 'nowrap'));
		$ret.= $this->Html->tag('b', 'Convênio: ');
		$ret.= $consulta['Convenio']['nome'];
		$ret.= $this->Html->tag('/span');
		$ret.= $this->Html->tag('/div');
		
		if(!empty($consulta['Consulta']['paciente_pagou'])
		&& !empty($consulta['FinancasForma']['nome'])) {
			$ret.= $this->Html->tag('div');
			$ret.= $this->Html->tag('b', 'Forma de pagamento: ');
			$ret.= $consulta['FinancasForma']['nome'];
			$ret.= $this->Html->tag('/div');
		}

		if(!empty($consulta['Consulta']['descricao'])) {
			$ret.= $this->Html->tag('div');
			$ret.= $this->Html->tag('b', 'Descrição: ');
			$ret.= $consulta['Consulta']['descricao'];
			$ret.= $this->Html->tag('/div');
		}
		$ret.= $this->Html->tag('div', '', array('class' => 'clear'));
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function webcamParaFoto() {
		$ret = '';
		$ret.= $this->Html->tag('div', null, array(
			'class' => 'zero',
		));
		$ret.= $this->Html->tag('div', '', array(
			'id' => 'webcam',
			'width' => 320,
			'height' => 240,
			'class' => 'zero',
		));
		$ret.= $this->Form->button('Fotografar!', array(
			'type' => 'button',
			'onclick' => "take_snapshot(); $('#webcam').parent().hide(); $('#canvas').parent().show(); return false;",
		));
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, array(
			'class' => 'zero',
			'style' => 'display: none;',
		));
		$ret.= $this->Html->tag('div', '', array(
			'id' => 'canvas',
			'width' => 320,
			'height' => 240,
		));
		$ret.= $this->Form->button('Outra foto!', array(
			'type' => 'button',
			'onclick' => "take_snapshot(); $('#canvas').parent().hide(); $('#webcam').parent().show(); return false;",
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Form->hidden('foto', array(
			'id' => 'canvasInput',
			'value' => '',
		));
		$ret.= $this->Html->tag('div', '', array('class' => 'clear'));
		
		$ret.= $this->Html->script('webcamjs/webcam');
		$ret.= $this->Html->script('load_webcamjs');
		return $ret;
	}
	public function ajaxDivNoRecursive($url) {
		$divId = String::uuid();
		$url = $this->Html->url($url, true);
		$this->Js->buffer("loadSimpleAjaxLink('#$divId', '$url');");
		return $this->Html->tag('div', '', array('id' => $divId));
	}
	function ajaxSpanNoLoad($url) {
		$divId = String::uuid();
		$url = $this->Html->url($url, true);
		$this->Js->buffer("loadSimpleAjaxLinkSemLoad('#$divId', '$url');");
		return $this->Html->tag('span', '', array('id' => $divId));
	}
	function ajaxDiv($url) {
		$divId = String::uuid();
		$url = $this->Html->url($url, true);
		$this->Js->buffer("loadAjaxLink('#$divId', '$url');");
		return $this->Html->tag('div', '', array('id' => $divId));
	}
	function youtubeVideo(&$video) {
		$youtubeCode = $video['youtube'];
		return $this->Html->tag('iframe', '', array(
			'src' => "http://www.youtube-nocookie.com/embed/$youtubeCode?wmode=transparent",
			'frameborder' => 0,
			'allowfullscreen',
			'style' => 'height: 100%; width: 100%;'
		));
	}
	function urlDoTexto($texto) {
		$linkUrl = "/blog/$texto[id]/";
		$linkUrl.= Inflector::slug($texto['titulo']);
		return $linkUrl;
	}
	function parametrosUrl() {
		return array_merge($this->params['pass'], $this->params['named']);
	}
	function movimentacao($valor) {
		$ret = null;
		if($valor < 0) {
			$digito = 'D';
			$valor = substr($valor, 1);
			$cor = '#FF0000';
		} else {
			$digito = 'C';
			$cor = '#0000FF';
		}

		$ret.= $this->Html->tag('span', null, array('style' => "color: $cor; white-space: nowrap;"));
		$ret.= $this->brFloat($valor);
		$ret.= ' ';
		$ret.= $digito;
		$ret.= $this->Html->tag('/span');
		return $ret;
	}
	function movimentacaoSemCor($valor) {
		$ret = null;
		if($valor < 0) {
			$digito = 'D';
			$valor = substr($valor, 1);
		} else {
			$digito = 'C';
		}
		
		$ret.= $this->brFloat($valor);
		$ret.= ' ';
		$ret.= $digito;
		return $ret;
	}
	public function captchaInput($options) {
		$options['div']['class'] = 'required';
		
		$options['label'] = 'Seis letras';
		$options['style'] = 'text-align: center; width: 5em;';
		$options['value'] = '';
		$options['required'] = true;
		return $this->Form->input('captcha', $options);
	}
	public function captchaImagem() {
		$url = $this->Html->url('/usuarios/captcha_image');
		$this->Js->buffer("loadCaptchaImage('#captcha', '$url');");
		return $this->Html->image('/usuarios/captcha_image', array(
			'id' => 'captcha'
		));
	}
	public function captchaLinkParaRecarregarImagem() {
		$url = $this->Html->url('/usuarios/captcha_image');
		return $this->Html->link('Reload image', "javascript:void(0);", array(
			'class' => 'no-ajax',
			'onclick' => "loadCaptchaImage('#captcha', '$url');",
		));
	}
	public function linkParaEsqueciMinhaSenha() {
		$this->Js->buffer("loadDlgEsqueciMinhaSenha();");
		
		$linkTxt = null;
		$linkTxt.= $this->Html->image('icones/help.png');
		$linkTxt.= ' esqueci minha senha';
		return $this->Html->link($linkTxt,
			array(
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
	function css($css = array()) {
		$ret = null;
		$ret.= $this->Html->tag('style', null, array('type' => 'text/css'));
		foreach($css as $selector => $properties) {
			$ret.= $selector;
			$ret.= '{';
			foreach($properties as $property => $value) {
				$ret.= $property;
				$ret.= ':';
				$ret.= $value;
				$ret.= ';';
			}
			$ret.= '}';
		}
		$ret.= $this->Html->tag('/style');
		return $ret;
	}
	function porcentagem($quantidade, $total = null) {
		if((!$quantidade && !$total) || $total === 0) {
			return '-';
		}
		$ret = null;
		$ret.= $this->Html->tag('span');
		if(!$total) {
			$ret.= $this->brFloat(100*$quantidade, 2);
		}
		else {
			$ret.= $this->brFloat(100*$quantidade/$total, 2);
		}
		$ret.= '%';
		$ret.= $this->Html->tag('/span');
		return $ret;
	}
	function sumarizar($paragraph, $limit = 200) {
		return $this->Text->truncate(trim(strip_tags($paragraph)), $limit, array(
			'ellipsis' => '...',
			'exact' => true,
			'html' => false
		));
	}

	function tempo($segundos) {
		$ret = '';
		if($segundos > 3600) {
			$horas = floor($segundos / 3600);
			$ret.= $horas;
			$ret.= 'h ';
			$segundos = $segundos - (3600 * $horas);
		}
		if($segundos > 60) {
			$minutos = floor($segundos / 60);
			$ret.= $minutos;
			$ret.= 'm ';
			$segundos = $segundos - (60 * $minutos);
		}
		$segundos = floor($segundos);
		$ret.= $segundos;
		$ret.= 's';

		return $ret;
	}

	function brFloat($valor, $precisao = 2) {
		return number_format(doubleval(str_replace(',', '', $valor)), $precisao, ',', '.');
	}
	function brDate($date, $format = 'd-m-Y') {
		if(!$date) {
			return $date;
		}
		return date($format, strtotime($date));
	}
	function moedaReal($valor, $decimals = 2) {
		$ret = null;
		if($valor < 0) {
			$ret.= '- ';
			$valor = substr($valor, 1);
		}
		$ret.= 'R$ ';
		$ret.= $this->brFloat($valor, $decimals);
		return $ret;
	}

	function urlSlugged() {
		$url = $this->Html->url();
		return strtolower(Inflector::slug($url));
	}
	
	function ultimosAnosOptions() {
		$cacheSearch = "Ultimos.Anos.Options";
		$anos = Cache::read($cacheSearch, 'long');
		if(!empty($anos)) {
			return $anos;
		}
		$max_anos = 25; 
		$ano_atual = date('Y');
		$anos = array();
		for ($a = $ano_atual; $a > $ano_atual - $max_anos; --$a) {
			$anos[$a] = $a;
		}
		Cache::write($cacheSearch, $anos, 'long');
		return $anos;
	}
}