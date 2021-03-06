<?php

class View {
    /**
     * @param $name имя шаблона, который нужно отобразить ( отображается вместе с заголовком и подвалом)
     */
    public function contain($name, array $data = array()) {
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'header.php';
        $this->containPartial($name, $data);
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'footer.php';
    }

    /**
     * @param $name имя шаблона, который нужно отобразить. Отображается только шаблон
     */
    public function containPartial($name, array $data = array()) {
        if (!empty($data)) {
            extract($data);
        }
        require(BASE_PATH . 'views' . DIRECTORY_SEPARATOR . $name . '.php');
    }

}