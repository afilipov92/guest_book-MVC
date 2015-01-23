<?php

class Model {
    protected static $db;
    protected $errors;
    protected static $instance;

  /*  public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8;', DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            echo 'Подключение не удалось' . $e->getMessage();
        }
    }*/

    public function __construct() {
    }

    public static function model()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
    }

    public static function db(){
        if (!self::$db) {
            self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8;', DB_USER, DB_PASSWORD);
        }
        return self::$db;
    }

    /**
     * Устанавливает в модель группу атрибутов из массива
     * @param array $arr ассоциативный массив имя свойства - значение
     */
    public function setAttributes(array $arr) {
        foreach ($arr as $key => $val) {
            $this->$key = $val;
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public static  function getAmountRecords(){
        $amount = self::db()->query("SELECT COUNT(*) AS count FROM " . DB_PREFIX ."gb_messages", PDO::FETCH_ASSOC)->fetch();
        return $amount['count'];
    }

}