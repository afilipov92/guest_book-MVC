<?php

class BaseController{
    protected $view;

    public function __construct() {
        $this->view = new View();
        $this->view->title = get_class($this);
    }

    public function indexAction() {
        echo __METHOD__ . "<br/>";
    }
}