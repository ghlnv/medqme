<?php
/**
 *
 * PHP 5
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

if(isset($contentReload)) {
	$urlDoContent = $this->Html->url($contentReload);
	$this->Js->buffer("reloadContent('$urlDoContent')");
}
if(isset($fecharDialog)) {
	echo $this->Html->tag('div', '', array(
		'class' => 'closeDialog',
		'style' => 'margin: 0; padding: 0;'
	));
	$this->Js->buffer("$('.closeDialog').parent().dialog('close')");
}

if(!isset($fecharDialog) || !isset($contentReload)) {
	echo $this->Session->flash();
}
echo $content_for_layout;
echo $this->Js->writeBuffer();