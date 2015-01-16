<?php

class GuestBookController extends BaseController {
    public function indexAction(){
        $message = new MessageGBModel();
        if($this->isPost()){
            $message->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if($message->isFormVaild() AND $captcha){
                $message->messageText = "";
                echo "Сообщение сохраненно";
            } else {
                echo "Данные не валидны";
                if(!$captcha){
                    echo "Каптча не валидна";
                }
            }

        }
        $this->view->switchOn('guestbook/form');
    }
}