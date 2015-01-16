<?php

class View {
    /**
     * подключает файл для отображения
     * @param $name
     */
    public function switchOn($name) {
        require_once('inc/views/' . $name . '.php');
    }
}