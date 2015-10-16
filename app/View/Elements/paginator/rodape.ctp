<?php 
echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, [
	'class' => 'col-md-8',
]);
echo $this->Html->tag('div', null, [
	'style' => 'margin: 10px;',
]);
if (!$this->Paginator->counter('%count%')) {
	echo $this->Html->div('highlight', 'Nenhuma ocorrência encontrada para os parâmetros especificados!');
}
else {
	echo $this->Paginator->counter(
		'Página %page% de %pages%, exibindo %current% de um total de %count% ocorrências'
	);
}
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, [
	'class' => 'col-md-4',
]);
echo $this->Html->tag('div', null, [
	'class' => 'paging',
]);
echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers([
	'separator' => '',
	'modulus' => 5,
]);
echo $this->Paginator->next('próxima >', array(), null, array('class' => 'next disabled'));
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');