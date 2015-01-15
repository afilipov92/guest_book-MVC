<?php

class BaseController {
    /**
     * @var View
     */
    protected $view;
    /**
     * @var SessionModel
     */
    protected $session;

    /**
     * создает объекты View и SessionModel
     * в view->session заносит экзепляр session
     * в title заносит название класса
     */
    public function __construct() {
        $this->view = new View();
        $this->session = new SessionModel();
        $this->view->session = $this->session;
        $this->view->title = get_class($this);
    }

    /**
     * метод по умолчанию
     */
    public function indexAction() {
        echo __METHOD__ . "<br/>";
    }

    /**
     * редиректит на переданный url
     * @param $url
     */
    public function redirect($url) {
        header('Location: '.$url);
        die;
    }
}