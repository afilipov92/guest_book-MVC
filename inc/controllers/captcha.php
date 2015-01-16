<?php

class CaptchaController extends BaseController {
    /**
     * создание каптчи
     */
    public function indexAction() {
        $question = Captcha::generateCaptcha();
        $image = new ImageModel($question);
        $image->send();
    }
}