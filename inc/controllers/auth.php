<?php

class AuthController extends BaseController {
    /**
     * обрабатывает данные отправленные из формы
     * заносит данные в сессию, если пользователь существует
     * отображает форму для авторизации
     */
    public function loginAction() {
        if ($this->session->isLoggedIn()) {
            $this->redirect(BASE_URL);
        }

        $this->view->msg = '';
        $this->view->login = isset($_POST['login']) ? trim(htmlspecialchars($_POST['login'])) : '';
        $this->view->password = isset($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : '';

        if (!empty($_POST)) {
            if ($this->session->login($this->view->login, $this->view->password)) {
                $this->redirect(BASE_URL);
            } else {
                $this->view->msg = "Ошибка входа";
            }
        }
        $this->view->turnOn('auth/login');
    }

    /**
     * выполняет действия по выходу
     * разрушает сессию
     * и редиректит на базовую страницу
     */
    public function logoutAction() {
        $this->session->logout();
        $this->redirect(BASE_URL);
    }
}