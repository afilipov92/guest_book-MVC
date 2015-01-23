<?php

class View {
    /**
     * @param $name имя шаблона, который нужно отобразить ( отображается вместе с заголовком и подвалом)
     */
    public function switchOn($name, array $data = array()) {
        require 'inc/views/header.php';
        $this->switchOnPartial($name, $data);
        require 'inc/views/footer.php';
    }

    /**
     * @param $name имя шаблона, который нужно отобразить. Отображается только шаблон
     */
    public function switchOnPartial($name, array $data = array()) {
        if (!empty($data)) {
            extract($data);
        }
        require('inc/views/' . $name . '.php');
    }

}