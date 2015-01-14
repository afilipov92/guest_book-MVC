<?php

class MainController {

    public function __construct() {
        echo __CLASS__ . "<br/>";
    }

    public function indexAction() {
        echo __METHOD__ . "<br/>";
    }
}