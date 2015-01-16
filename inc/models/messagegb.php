<?php

class MessageGBModel extends Model {
    public $userName = "";
    public $userEmail = "";
    public $messageText = "";
    public $date;
    protected $errors;

    public function __construct(){
        parent::__construct();
        $this->date = date('Y-m-d H:i:s');
    }

    public function isFormVaild(){
        $resp = true;
        $this->errors = array();

        if(preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$/', $this->userName) == 0){
            $resp = false;
            $this->errors['userName'] = 'Проверьте ввод имени';
        }

        if(preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $this->userEmail) == 0){
            $resp = false;
            $errors['userEmail'] = 'Проверьте ввод email';
        }

        if(strlen($this->messageText) < 50){
            $resp = false;
            $errors['messageText'] = 'Сообщение должно содержать от 50 символов';
        }
        return $resp;
    }

    public function getErrors(){
        if(!is_array($this->errors)){
            $this->isValid();
        }

        return $this->errors;
    }
}