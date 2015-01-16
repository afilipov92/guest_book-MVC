<?php

class CaptchaController extends BaseController {
    public static  function showAction(){
        $question = Captcha::generateCaptcha();
        $image = new ImageModel($question);
        $image->send();
    }
}