<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $this->title ?></title>
</head>
<body>
<div class="auth-block">
    <?php
    if($this->session->isLoggedIn()){
        echo $this->session->getName();
        echo '<a href="'.'auth/logout'.'">Выйти</a>';
    } else {
        echo '<a href="'.'auth/login'.'">Войти</a>';
    }
    ?>
</div>
    <h1>Main page - index</h1>
</body>
</html>