<?php

class View {
    /**
     * @param $name имя шаблона, который нужно отобразить ( отображается вместе с заголовком и подвалом)
     */
    public function switchOn($name, array $data = array()) {
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'header.php';
        $this->switchOnPartial($name, $data);
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'footer.php';
    }

    /**
     * @param $name имя шаблона, который нужно отобразить. Отображается только шаблон
     */
    public function switchOnPartial($name, array $data = array()) {
        if (!empty($data)) {
            extract($data);
        }
        require(BASE_PATH . 'views' . DIRECTORY_SEPARATOR . $name . '.php');
    }

}