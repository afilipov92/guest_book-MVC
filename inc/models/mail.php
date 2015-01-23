<?php

class MailModel {
    public static function goMail($userName, $userEmail) {
        $mail = new PHPMailer();
        $message = "Уважаемый " . $userName . ",<br/>
            Спасибо за то, что Вы  создали аккаунт у нас. Для того чтобы активировать Ваш профайл нажмите на ссылку ниже:<br/>
            <a href='http://" . $_SERVER['HTTP_HOST'] . "/guest_book-MVC/registration/activation/" . $userName . "/" . md5($userName) . "' target='_blank'>
            http://" . $_SERVER['HTTP_HOST'] . "guest_book-MVC/registration" . "</a>";
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