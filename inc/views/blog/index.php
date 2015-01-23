<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $this->title ?></title>
</head>
<body>
<div class="auth-block">
    <?php
    if ($this->session->isLoggedIn()) {
        echo $this->session->getName();
        echo '<a href="' . 'auth/logout' . '">Выйти</a>';
    } else {
        echo '<a href="' . 'auth/login' . '">Войти</a>';
    }
    ?>
</div>
<h1>Blog</h1>
<?php
if($this->session->isLoggedIn()){
    ?>
    <form method="get" action="blog/addnote">
        <input type="submit" name="submit" value="Добавить запись"/>
    </form>
<?php
}
?>
<div class="messages">
    <?php foreach ($this->notes as $msg) {
        $this->switchOnPartial('blog/parts/note', array('note' => $msg));
    } ?>
</div>
</body>
</html>