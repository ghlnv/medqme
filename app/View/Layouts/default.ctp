<?php
/**
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
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?> :
		<?php echo 'MedQMe' ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('layout');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('jquery-ui.structure.min');
		echo $this->Html->css('jquery-ui.theme.min');
		
		echo $this->Html->script('jquery-2.1.4.min');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('jquery.mask');
		echo $this->Html->script('custom-default');
		echo $this->Html->script('custom-ajax');
		echo $this->Html->script('custom-dialogs');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<header>
			<h1><?php echo $this->Html->link($this->Html->image('medqme.png'), '/', array(
				'alt' => 'MedQMe',
				'escape' => false,
				'title' => 'Voltar para página inicial',
			)); ?></h1>
			<div><?php if(AuthComponent::user('id')) { 
				echo $this->element('html/user');
			}
			?></div>
		</header>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<footer>
			<div class="clearfix">
				<span><a href="http://www.facebook.com/medqme" target="_blank">Facebook</a> • <a href="http://twitter.com/medqme" target="_blank">Twitter</a> • <a href="mailto:contato@medqme.com.br">contato@medqme.com.br</a></span>
				<small>©<?php echo date('Y'); ?> — <b>MedQMe</b></small>
			</div>
		</footer>
	</div>
	<?php
		echo $this->element('sql_dump');
		echo $this->Js->writeBuffer();
	?>	
</body>
</html>
