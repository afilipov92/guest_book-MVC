<?php

class GuestBookController extends BaseController {
    /**
     * обработка формы и её отрисовка
     */
    public function indexAction($page = 1) {
        $message = new MessageGBModel();
        $this->view->result = "";
        if ($this->isPost()) {
            $message->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if ($message->isFormVaild() AND $captcha) {
                if ($message->insertMessage()) {
                    $this->view->result = "Сообщение сохраненно";
                } else {
                    $this->view->result = "Ошибка сохранения";
                }
            } else {
                $this->view->gbErrors = $message->getErrors();
                if (!$captcha) {
                    $this->view->gbErrors['captcha'] = 'Неверный ответ';
                }
            }

        }
        $this->view->messages = $message->getItemsForPage($page);
        $this->view->msg = $message;

        $messagesCount = Model::getAmountRecords();
        $this->view->currentPage = $page;
        $this->view->totalPages = $pages = ceil($messagesCount / PAGE_SIZE_FOR_GB);
        $this->view->pagerLinkTpl = BaseController::url('guestbook', 'index', '{{PAGE}}');

        $this->view->contain('guestbook/index');
    }
}