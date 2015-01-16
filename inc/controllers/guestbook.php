<?php

class GuestBookController extends BaseController {
    /**
     * обработка формы и её отрисовка
     */
    public function indexAction() {
        $message = new MessageGBModel();
        if ($this->isPost()) {
            $message->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if ($message->isFormVaild() AND $captcha) {
                if ($message->insertMessage()) {
                    echo "Сообщение сохраненно";
                } else {
                    echo "Ошибка сохранения";
                }
            } else {
                echo "Данные не валидны";
                if (!$captcha) {
                    echo "Каптча не валидна";
                }
            }

        }
        $this->view->switchOn('guestbook/form');
    }
}