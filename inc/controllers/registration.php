<?php

class RegistrationController extends BaseController {
    public function indexAction() {
        if ($this->session->isLoggedIn()) {
            $this->redirect(BASE_URL);
        }
        $newUser = new RegistrationModel ();
        $this->view->result = "";
        if ($this->isPost()) {
            $newUser->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if ($newUser->isFormVaild() AND $captcha) {
                if (MailModel::goMail($newUser->userName, $newUser->userEmail)) {
                    if ($newUser->addUser()) {
                        $this->view->result = "Вы успешно зарегистрировались";
                    } else {
                        $this->view->result = "Ошиба регистрации";
                    }
                } else {
                    $this->view->gbErrors['mail'] = "Ошибка отправки письма";
                }
            } else {
                $this->view->gbErrors = $newUser->getErrors();
                if (!$captcha) {
                    $this->view->gbErrors['captcha'] = "Каптча не валидна";
                }
            }
        }
        $this->view->msg = $newUser;
        $this->view->switchOn('registration/form');
    }

    public function activationAction($userName, $hash) {
        $result = RegistrationModel::getHashDB($userName, $hash);
        if ($result) {
            RegistrationModel::updateHashDB($result['id']);
            $msg = "Ваша учетная записать активирована<br/><a href='" . BASE_URL . "'>Перейти на главную страницу</a>";
        } else {
            $msg = "Ошибка активации учетной записи<br/><a href='" . BASE_URL . "'>Перейти на главную страницу</a>";
        }
        echo $msg;
    }
}