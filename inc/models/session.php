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
     * @param $userName
     * @param $password
     * @return bool|mixed
     */
    public function login($userName, $password) {
        $ob = new UserModel();
        $this->user = $ob->requestSelectUser($userName, md5($password));
        return $this->user;
    }

    /**
     * устанавливает значение каптчи в сессию
     * @param $captcha
     */
    public static function setCaptcha($captcha){
        $_SESSION['captcha'] = $captcha;
    }

    /**
     * возвращает каптчу, если она была установлена
     * @return string
     */
    public static function getCaptcha(){
        return isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
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
     * возвращает ид пользователя, если он залогинен
     * @return string
     */
    public function getId() {
        return $this->isLoggedIn() ? $_SESSION['id_user'] : '';
    }

    /**
     * заносит данные в сессию
     */
    public function __destruct() {
        if ($this->user) {
            $_SESSION['userName'] = $this->user['userName'];
            $_SESSION['id_user'] = $this->user['id'];
        }
    }
}