<?php

use view\formBase\Form;
use view\formBase\Input;
use view\formBase\Submit;

$form = (new Form)->setAttrs(['action' => 'scriptRegistr.php', 'method' => 'POST']);
	
	echo $form->open();
		echo (new Input)->setAttr('type', 'text')->setAttr('name', 'userName' )->setAttr('required' )->setAttr('placeholder', 'Введите имя ...') . '<br>' . '<br>';
        echo (new Input)->setAttr('type', 'text')->setAttr('name', 'email')->setAttr('placeholder', 'Введите адрес ...') . '<br>' . '<br>';
		echo (new Input)->setAttr('type', 'text')->setAttr('name', 'password')->setAttr('required' )->setAttr('placeholder', 'Введите пароль ...') . '<br>' . '<br>';
        echo (new Input)->setAttr('type', 'text')->setAttr('name', 'repeatpassword')->setAttr('required' )->setAttr('placeholder', 'Подтвердите пароль ...') . '<br>' . '<br>';
		
		echo new Submit . '<br>' . '<br>';

        
        
	echo $form->close();
    