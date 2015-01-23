<?php
$this->switchOnPartial('guestbook/parts/form');
?>

<div class="messages">
    <?php foreach ($this->messages as $msg) {
        $this->switchOnPartial('guestbook/parts/message', array('message' => $msg));
    } ?>
</div>

<?php
$this->switchOnPartial('common/pager', array(
    'currentPage' => $this->currentPage,
    'totalPages' => $this->totalPages,
    'pagerLinkTpl' => $this->pagerLinkTpl
));
?>