<?php

class RegistrationController extends BaseController {
    public function indexAction() {
        if ($this->session->isLoggedIn()) {
            $this->redirect(BASE_URL);
        }
        $newUser = new RegistrationModel ();
        if ($this->isPost()) {
            $newUser->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if ($newUser->isFormVaild() AND $captcha) {
                if(MailModel::goMail($newUser->userName , $newUser->userEmail)){
                    if ($newUser->addUser()) {
                        $msg = "Вы успешно зарегистрировались";
                    } else {
                        $msg = "Ошиба регистрации";
                    }
                } else {
                    $msg = "Ошибка отправки письма";
                }
            } else {
                $msg = "Не верные данные при регистрации";
                if (!$captcha) {
                    $msg .= "Каптча не валидна";
                }
            }
            echo $msg;
        }
        $this->view->switchOn('registration/form');
    }
}