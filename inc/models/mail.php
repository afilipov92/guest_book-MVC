<?php

class MailModel {
    /**
     * генерирует письмо вользователю и отправляет его на
     * емаил этого пользователя
     * @param $userName
     * @param $userEmail
     * @return bool
     */
    public static function goMail($userName, $userEmail) {
        $mail = new PHPMailer();
        $message = sprintf('Уважаемый %1$s,<br/>
            Спасибо за то, что Вы  создали аккаунт у нас. Для того чтобы активировать Ваш профайл нажмите на ссылку ниже:<br/>
            <a href="http://%2$s/guest_book-MVC/registration/activation/%1$s/%3$s" target="_blank">
            http://%2$s/guest_book-MVC/registration</a>', $userName, $_SERVER['HTTP_HOST'], md5($userName));
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->SMTPSecure = SMTP_SEC;
        $mail->Host = MAIL_HOST;
        $mail->Port = MAIL_PORT;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;

        $mail->SetFrom(MAIL_USERNAME);
        $mail->CharSet = CHAR_SET;
        $mail->Subject = 'Регистрация на форуме';
        $mail->MsgHTML($message);
        $mail->AddAddress($userEmail);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}