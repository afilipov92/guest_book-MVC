<?php

class UserModel extends Model {
    public $userName = "";
    public $userEmail = "";
    public $password = "";
    public $passwordConfirm = "";

    /**
     * проверяет валидность формы
     * @return bool
     */
    public function isFormVaild() {
        $this->errors = array();
        if (preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$/', $this->userName) == 0) {
            $this->errors['userName'] = 'Логин должен быть от 5 до 20 символов';
        }
        if ($this->requestSelectUserName($this->userName) != false) {
            $this->errors['userName'] = 'Пользователь с таким логином уже существует';
        }
        if ($this->requestSelectUserEmail($this->userEmail) != false) {
            $this->errors['userEmail'] = 'Пользователь с таким E-mail уже существует';
        }
        if (preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $this->userEmail) == 0) {
            $this->errors['userEmail'] = 'Проверьте ввод email';
        }
        if (preg_match('/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $this->password) == 0) {
            $this->errors['password'] = "Проверьте ввод пароля (пароль должен быть от 6 символов, должны присутствовать:\n
            загланвые буквы, цифры, допускаются спец символы)";
        }
        if ($this->password != $this->passwordConfirm) {
            $errors['password'] = 'Пароли не совпадают';
        }
        return empty($this->errors);
    }

    /**
     * сохраняет данные из формы в базу данных
     * @return bool
     */
    public function addUser() {
        $ins = self::db()->prepare('INSERT INTO ' . DB_PREFIX . 'users (userName, userEmail, password, id_status, hash) VALUES (:userName, :userEmail, :password, :id_status, :hash)');
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
    public function requestSelectUserName($userName) {
        $sth = self::db()->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE userName=:userName");
        $sth->execute(array('userName' => $userName));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($mas)) {
            return $mas;
        } else {
            return false;
        }
    }

    /**
     * выборка из таблицы users по userEmail
     * @param $userEmail
     * @return bool|mixed
     */
    public function requestSelectUserEmail($userEmail) {
        $sth = self::db()->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE userEmail=:userEmail");
        $sth->execute(array('userEmail' => $userEmail));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($mas)) {
            return $mas;
        } else {
            return false;
        }
    }

    /**
     * Выборка из таблицы users по userName и hash
     * @param $userName
     * @param $hash
     * @return bool|mixed
     */
    public static function getHashDB($userName, $hash) {
        $sth = self::db()->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE userName = :userName AND hash = :hash");
        $sth->execute(array('userName' => $userName, 'hash' => $hash));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($mas)) {
            return $mas;
        } else {
            return false;
        }
    }

    /**
     * обновляет hash в таблице users
     * @param $id
     * @return bool
     */
    public static function updateHashDB($id){
        $sth = self::db()->prepare("UPDATE " . DB_PREFIX . "users SET hash=:hash WHERE id=:id");
        return $sth->execute(array('hash' => 'actived', 'id' => $id));
    }
    /**
     * выборка по пользователю и паролю
     * @param $userName
     * @param $pass
     * @return bool|mixed
     */
    public function requestSelectUser($userName, $pass) {
        $sth = self::db()->prepare('SELECT * FROM ' . DB_PREFIX . 'users WHERE userName = :userName AND password = :pass');
        $sth->execute(array('userName' => $userName, 'pass' => $pass));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($mas)) {
            return $mas;
        } else {
            return false;
        }
    }
}