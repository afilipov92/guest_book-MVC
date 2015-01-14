<?php

class View{
    public function turnOn($name){
        require_once('inc/views/' . $name . '.php');
    }
}