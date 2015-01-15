<?php

class UserModel {
    /**
     * @var array
     */
    protected static $users = array(
        array('id' => 1, 'login' => 'admin', 'password' => 'admin'),
        array('id' => 2, 'login' => 'user', 'password' => '1234')
    );

    /**
     * ищет пользователя по логину и паролю
     * @param array $data
     * @return bool
     */
    public static  function find(array $data){
        foreach(self::$users as $a){
            if ($a['login'] == $data['login'] && $a['password'] == $data['password']){
                return $a;
            }
        }
        return false;
    }
}