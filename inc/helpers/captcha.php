<?php

class Captcha {
    /**
     * Генерирует капчу. Возвращает вопрос. Ответ устанавливает в сессию
     * @return string
     */
    public static function generateCaptcha(){
        $answ = rand(1, 20);
        $marker = rand(0,1)? '+': '-';
        $b = rand(1,$answ);
        switch($marker){
            case '+':
                $a = $answ - $b;
                break;
            case '-':
                $a = $answ + $b;
                break;
        }
        $_SESSION['captcha'] = $answ;
        return $a.$marker.$b;
    }

    public static function isValidCaptcha($answ){
        $rightAnsw = isset($_SESSION['captcha'])? $_SESSION['captcha']: '';
        return $answ == $rightAnsw;
    }
}