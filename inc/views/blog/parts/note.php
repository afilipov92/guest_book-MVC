<div class="panel panel-default">
    <div class="panel-heading"><strong><?= htmlspecialchars($note->title) ?></strong> <?= $note->date ?></div>
    <div class="panel-body">
        <?= htmlspecialchars($note->description) ?>
    </div>
</div>