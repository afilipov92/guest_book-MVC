<?php

class UserModel extends Model {
    /**
     * @var array
     */
    protected static $users = array(
        array('id' => 1, 'login' => 'admin', 'password' => 'admin'),
        array('id' => 2, 'login' => 'user', 'password' => '1234')
    );

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