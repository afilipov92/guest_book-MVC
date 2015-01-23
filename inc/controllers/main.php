<?php

class MainController extends BaseController {
    /**
     * подгружает index.php из main
     */
    public function indexAction() {
        $this->view->contain('main/index');
    }
}