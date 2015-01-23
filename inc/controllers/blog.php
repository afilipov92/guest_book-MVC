<?php

class BlogController extends BaseController {
    /**
     * подгружает index.php из blog
     */
    public function indexAction($page = 1) {
        $note = new NoteModel();
        $this->view->notes = $note->getItemsForPage($page);
        $this->view->switchOn('blog/index');
    }

    public function addNoteAction($page = 1) {
        if (!$this->session->isLoggedIn()) {
            $this->redirect(BASE_URL);
        }

        $note = new NoteModel();
        $note->id_author = $this->session->getId();
        $this->view->result = "";
        if ($this->isPost()) {
            $note->setAttributes($_POST);
            $captcha = Captcha::isValidCaptcha($_POST['captcha']);
            if ($note->isFormValid() AND $captcha) {
                if ($note->insertNote()) {
                    $this->redirect(BaseController::url('blog', 'index'));
                } else {
                    $this->view->result = "Ошибка сохранения";
                }
            } else {
                $this->view->gbErrors = $note->getErrors();
                if (!$captcha) {
                    $this->view->gbErrors['captcha'] = 'Неверный ответ';
                }
            }

        }
        $this->view->msg = $note;

        $this->view->switchOn('blog/form');
    }
}