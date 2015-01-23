<div><?= $this->result ?></div>
<form class="form-horizontal" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Добавление записи</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">Название</label>

            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="введите название записи"
                       class="form-control input-md" required="" value="<?= $this->msg->title ?>">
            </div>
            <p class="help-block" data-name="title"></p>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Краткое описание</label>

            <div class="col-md-4">
                <textarea class="form-control" id="description" name="description"
                          placeholder="Введите краткое описание"><?= $this->msg->description ?></textarea>
            </div>
            <p class="help-block" data-name="description"></p>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="text">Полный текст</label>

            <div class="col-md-4">
                <textarea class="form-control" id="text" name="text"
                          placeholder="Введите текст записи"><?= $this->msg->text ?></textarea>
            </div>
            <p class="help-block" data-name="text"></p>
        </div>

        <!-- Prepended text-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="captcha">Защита от роботов</label>

            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon" style="padding: 0;"><img src="../captcha"/></span>
                    <input id="captcha" name="captcha" class="form-control" placeholder="Введите ответ" type="text"
                           required="">
                </div>
                <p class="help-block" data-name="captcha"></p>
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="resetBtn"></label>

            <div class="col-md-8">
                <button id="resetBtn" name="resetBtn" type="reset" class="btn btn-inverse">Сбросить</button>
                <button id="sendBtn" name="sendBtn" type="submit" class="btn btn-success">Отправить</button>
            </div>
        </div>

        <?php
        if (isset($this->gbErrors) AND !empty($this->gbErrors)) {
            ?>
            <div class="form-group">
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <ul>
                        <?php foreach ($this->gbErrors as $fieldName => $error) { ?>
                            <li><strong><?= $fieldName ?></strong> <?= $error ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

    </fieldset>
</form>