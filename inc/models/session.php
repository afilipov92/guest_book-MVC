<?php

class SessionModel {
    /**
     * @var хранит данные о пользователе
     */
    protected $user;

    /**
     * создает сессию
     */
    public function __construct(){
        session_start();
    }

    /**
     * проверяет залогинен ли пользователь
     * @return bool
     */
    public function isLoggedIn(){
        return isset($_SESSION['login']);
    }

    /**
     * проверяет пользователя по введенным данным
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password){
        $this->user = UserModel::find(array('login' => $login, 'password' => $password));
        return $this->user;
    }

    /**
     * разрушает все данные сессии
     */
    public function logout(){
        session_destroy();
        $this->user = false;
    }

    /**
     * возвращает логин пользователя, если он залогинен
     * @return string
     */
    public function getName()
    {
        return $this->isLoggedIn() ? $_SESSION['login'] : '';
    }

    /**
     * заносит данные в сессию
     */
    public function __destruct(){
        if($this->user){
            $_SESSION['login'] = $this->user['login'];
        }
    }
}