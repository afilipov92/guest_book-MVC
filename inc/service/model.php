<?php

class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8;', DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            echo 'Подключение не удалось' . $e->getMessage();
        }
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

}