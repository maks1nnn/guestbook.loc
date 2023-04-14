<?php

use view\formBase\Form;
use view\formBase\Input;
use view\formBase\Textarea;
use view\formBase\Submit;

$form = (new Form)->setAttrs(['action' => '', 'method' => 'POST']);
	
	echo $form->open();
		echo (new Input)->setAttr('name', 'user')->setAttr('placeholder', 'Введите имя ...') . '<br>' . '<br>';
        echo (new Input)->setAttr('name', 'email')->setAttr('placeholder', 'Введите адрес ...') . '<br>' . '<br>';
		echo (new Textarea)->setAttr('name', 'comment')->show() . '<br>' . '<br>';
		echo new Submit;
	echo $form->close();

	

	

    