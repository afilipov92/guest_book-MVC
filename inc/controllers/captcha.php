<?php

class CaptchaController extends BaseController {
    public function showAction(){
        $question = Captcha::generateCaptcha();
        $image = new ImageModel($question);
        $image->send();
    }
}