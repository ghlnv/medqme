<?php
echo $this->Html->tag('div', null, array(
	'class' => 'paging',
	'style' => 'margin-left: 2em;',
));
echo $this->Paginator->prev('<', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('>', array(), null, array('class' => 'next disabled'));
echo $this->Html->tag('/div');