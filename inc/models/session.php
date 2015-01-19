<?php

class SessionModel extends Model {
    /**
     * @var хранит данные о пользователе
     */
    protected $user;

    /**
     * создает сессию
     */
    public function __construct() {
        session_start();
    }

    /**
     * проверяет залогинен ли пользователь
     * @return bool
     */
    public function isLoggedIn() {
        return isset($_SESSION['userName']);
    }

    /**
     * проверяет пользователя по введенным данным
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($userName, $password) {
        $ob = new UserModel();
        $this->user = $ob->requestSelectUser($userName, md5($password));
        return $this->user;
    }

    /**
     * разрушает все данные сессии
     */
    public function logout() {
        session_destroy();
        $this->user = false;
    }

    /**
     * возвращает логин пользователя, если он залогинен
     * @return string
     */
    public function getName() {
        return $this->isLoggedIn() ? $_SESSION['userName'] : '';
    }

    /**
     * заносит данные в сессию
     */
    public function __destruct() {
        if ($this->user) {
            $_SESSION['userName'] = $this->user['userName'];
        }
    }
}