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

		// Default CSS
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('jquery-ui.structure.min');
		echo $this->Html->css('jquery-ui.theme.min');
		
		// JQuery
		echo $this->Html->script('jquery-2.1.4.min');
		
		// Bootstrap
		echo $this->Html->css('/vendor/bootstrap-3.3.5/css/bootstrap.min');
		echo $this->Html->css('/vendor/bootstrap-3.3.5/css/bootstrap-theme.min');
		echo $this->Html->css('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
		echo $this->Html->script('/vendor/bootstrap-3.3.5/js/bootstrap.min.js');
		
		// JQuery-UI
		echo $this->Html->script('jquery-ui.min');
		
		// Custom CSS
		echo $this->Html->css('layout');
		echo $this->Html->css('print');
		echo $this->Html->css('responsive');
		
		// CKEditor
		echo $this->Html->script('/vendor/ckeditor/ckeditor');
		
		// Javascript
		echo $this->Html->script('jquery.mask');
		echo $this->Html->script('custom-default');
		echo $this->Html->script('custom-ajax');
		echo $this->Html->script('custom-dialogs');
		echo $this->Html->script('custom-ckeditor');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php // echo $this->element('google/analytics'); ?>
	<header class="">
	<!-- Static navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<?php
					echo $this->Html->link($this->Html->image('medqme.png', ['style' => 'width: 100px;']), '/', array(
						'alt' => 'MedQMe',
						'title' => 'Voltar para página inicial',
						'class' => 'navbar-brand',
						'escape' => false,
					));
				?>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<?php
					echo $this->element('menu');
				?>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	</header>
	<div id="content">
		<?php
			echo $this->Session->flash();
			echo $this->fetch('content');
		?>
	</div>
	<footer>
	©<?php echo date('Y'); ?> — <b>MedQMe</b>
	<br>
	<span><a href="http://www.facebook.com/medqme" target="_blank">Facebook</a> • <a href="http://twitter.com/medqme" target="_blank">Twitter</a> • <a href="mailto:contato@medqme.com.br">contato@medqme.com.br</a></span>
	</footer>
	<?php
//		echo $this->element('sql_dump');
		echo $this->Js->writeBuffer();
	?>	
</body>
</html>
