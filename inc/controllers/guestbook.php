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
                $this->view->gbErrors = $message->getErrors();
                if (!$captcha) {
                    $this->view->gbErrors['captcha'] = 'Неверный ответ';
                }
            }

        }
        $this->view->msg = $message;
        $this->view->switchOn('guestbook/form');
    }
}