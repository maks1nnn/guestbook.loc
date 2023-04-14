<?php

namespace classes;

class Validator 
{
    private $data;
    private $errors = [];
    private static $fields = ['user' , 'email'];

    public function __construct($postData){
        $this->data = $postData;
    }

    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field is not present in data");
                return ;
            }
        }
        $this->validateUsername();
        $this->validateEmail();
        return $this->errors;

    }

    private function validateUsername(){
        $val = trim($this->data['user']);

        if(empty($val)){
            $this->addError('user', 'user cannot be empty');
        }else{
            if(!preg_match('/^[a-zA-Z0-9]{3,12}$/', $val)){
            $this->addError('user', 'user must be 3-12 chars & alphanumeric');
            }
        }

    }

    
    private function validateEmail(){
        $val = trim($this->data['email']);

        if(empty($val)){
            $this->addError('email', 'email cannot be emlpty');
        }else{
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                $this->addError('email', 'email must be a valid');
            }
        }

    }

    private function addError($key, $val){
        $this->errors[$key] = $val;

    }



    
}