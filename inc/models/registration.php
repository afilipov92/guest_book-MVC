<?php

class RegistrationModel extends Model {
    public $userName = "";
    public $userEmail = "";
    public $password = "";
    public $passwordConfirm = "";
    protected $errors;

    public  function isFormVaild(){
        $resp = true;
        $this->errors = array();
        if(preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$/', $this->userName) == 0){
            $resp = false;
            $this->errors['userName'] = 'Логин должен быть от 5 до 20 символов';
        }
        if($this->requestSelectUserName($this->userName) != false){
            $resp = false;
            $this->errors['userName'] = 'Пользователь с таким логином уже существует';
        }
        if($this->requestSelectUserEmail($this->userEmail) != false){
            $resp = false;
            $this->errors['userEmail'] = 'Пользователь с таким E-mail уже существует';
        }
        if(preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $this->userEmail) == 0){
            $resp = false;
            $this->errors['userEmail'] = 'Проверьте ввод email';
        }
        if(preg_match('/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $this->password) == 0){
            $resp = false;
            $this->errors['password'] = "Проверьте ввод пароля (пароль должен быть от 6 символов, должны присутствовать:\n
            загланвые буквы, цифры, допускаются спец символы)";
        }
        if($this->password != $this->passwordConfirm){
            $resp = false;
            $errors['password'] = 'Пароли не совпадают';
        }
        return $resp;
    }

    /**
     * сохраняет данные из формы в базу данных
     * @return bool
     */
    public function addUser() {
        $ins = $this->db->prepare('INSERT INTO ' . DB_PREFIX . 'users (userName, userEmail, password, id_status, hash) VALUES (:userName, :userEmail, :password, :id_status, :hash)');
        return $ins->execute(array(
            'userName' => $this->userName,
            'userEmail' => $this->userEmail,
            'password' => md5($this->password),
            'id_status' => ID_USER,
            'hash' => md5($this->userName)
        ));
    }

    /**
     * выборка из таблицы users по userName
     * @param $userName
     * @return bool|mixed
     */
    public function requestSelectUserName($userName){
        $sth = $this->db->prepare("SELECT * FROM users WHERE userName=:userName");
        $sth->execute(array('userName' => $userName));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * выборка из таблицы users по userEmail
     * @param $userEmail
     * @return bool|mixed
     */
    public function requestSelectUserEmail($userEmail){
        $sth = $this->db->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
        $sth->execute(array('userEmail' => $userEmail));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }
}