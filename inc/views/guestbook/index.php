<?php
$this->switchOnPartial('guestbook/parts/form');
?>

<div class="messages">
    <?php foreach ($this->messages as $msg) {
        $this->switchOnPartial('guestbook/parts/message', array('message' => $msg));
    } ?>
</div>