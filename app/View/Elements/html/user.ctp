<div class="login">
	<?php
		echo $this->Html->link(AuthComponent::user('Pessoa.nome'),
			'/pessoas/meuPerfil',
			array()
		);
		echo ' | ';
		echo $this->Html->link('sair',
			'/usuarios/sair',
			array()
		);
	?>
</div>