<?php

class Model {
    protected static $db;
    protected $errors;
    protected static $instance;

    public function __construct() {
    }

    public static function model() {
        if (!self::$instance) {
            self::$instance = new self;
        }
    }

    /**
     * взвращает объект соединения с базой данных
     * @return PDO
     */
    public static function db() {
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

    /**
     * возвращает ошибки
     * @return mixed
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * подсчет количества записей в таблице
     * @param $table
     * @return mixed
     */
    public static function getAmountRecords($table) {
        $amount = self::db()->query("SELECT COUNT(*) AS count FROM " . DB_PREFIX . $table, PDO::FETCH_ASSOC)->fetch();
        return $amount['count'];
    }

}