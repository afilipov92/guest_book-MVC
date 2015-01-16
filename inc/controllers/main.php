<?php

class MainController extends BaseController {
    /**
     * подгружает index.php из main
     */
    public function indexAction() {
        $this->view->switchOn('main/index');
    }
}