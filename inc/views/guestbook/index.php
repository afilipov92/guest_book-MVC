<?php
$this->containPartial('guestbook/parts/form');
?>

    <div class="messages">
        <?php foreach ($this->messages as $msg) {
            $this->containPartial('guestbook/parts/message', array('message' => $msg));
        } ?>
    </div>

<?php
$this->containPartial('common/pager', array(
    'currentPage' => $this->currentPage,
    'totalPages' => $this->totalPages,
    'pagerLinkTpl' => $this->pagerLinkTpl
));
?>