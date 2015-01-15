<?php

class MainController extends baseController {
    /**
     * подгружает index.php из main
     */
    public function indexAction() {
        $this->view->turnOn('main/index');
    }
}