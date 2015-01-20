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
                        echo  "Вы успешно зарегистрировались";
                    } else {
                        echo  "Ошиба регистрации";
                    }
                } else {
                    $this->view->gbErrors['mail'] = "Ошибка отправки письма";
                }
            } else {
                $this->view->gbErrors = $newUser->getErrors();
                if (!$captcha) {
                    $this->view->gbErrors['captcha']= "Каптча не валидна";
                }
            }
           // echo $msg;
        }
        $this->view->msg = $newUser;
        $this->view->switchOn('registration/form');
    }
}