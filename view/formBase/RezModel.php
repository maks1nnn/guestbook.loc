<?php

require 'Tag.php';
require 'Input.php';
require 'Form.php';
require 'Submit.php';
require 'Textarea.php';

$form = (new Form)->setAttrs(['action' => 'script.php', 'method' => 'POST']);
	
	echo $form->open();
		echo (new Input)->setAttr('name', 'user') . '<br>' . '<br>';
        echo (new Input)->setAttr('name', 'user') . '<br>' . '<br>';
		echo (new Textarea)->setAttr('name', 'message')->show() . '<br>' . '<br>';
		echo new Submit;
	echo $form->close();

