<h1>Blog</h1>
<?php
if ($this->session->isLoggedIn()) {
    ?>
    <form method="get" action="blog/addnote">
        <input type="submit" name="submit" value="Добавить запись"/>
    </form>
<?php
}
?>
<div class="messages">
    <?php foreach ($this->notes as $msg) {
        $this->containPartial('blog/parts/note', array('note' => $msg));
    } ?>
</div>
