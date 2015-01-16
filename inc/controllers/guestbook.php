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
        //$image = new ImageModel(Captcha::generateCaptcha());
       // $this->view->gbCaptchaQuestion = $image->send();
        $this->view->switchOn('guestbook/form');
    }
}