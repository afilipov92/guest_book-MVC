<?php

class MainController extends baseController{
    public function indexAction() {
        $this->view->turnOn('main/index');
    }
}