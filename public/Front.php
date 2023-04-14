<?php

use view\formBase\Form;
use view\formBase\Input;
use view\formBase\Textarea;
use view\formBase\Submit;

$form = (new Form)->setAttrs(['action' => '', 'method' => 'POST']);

echo $form->open();
echo (new Input)->setAttr('name', 'user')->setAttr('required')->setAttr('value', $name)->setAttr('placeholder', 'Введите имя ...') . '<br>' . '<br>';
echo (new Input)->setAttr('name', 'email')->setAttr('required')->setAttr('value', $email)->setAttr('placeholder', 'Введите адрес ...') . '<br>' . '<br>';
echo (new Textarea)->setAttr('name', 'comment')->setAttr('required')->show() . '<br>' . '<br>';
echo new Submit;
echo $form->close();
