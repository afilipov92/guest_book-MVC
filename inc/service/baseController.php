<?php

class BaseController{
    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    public function indexAction() {
        echo __METHOD__ . "<br/>";
    }
}