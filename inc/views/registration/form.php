<div><?= $this->result ?></div>
<div id="block">
    <p align="center"><b>Форма регистрации</b></p>

    <form name="form4" class="form1" method="post">
        <div>
            <label for="userName">Логин *:</label>
            <br/>
            <input id="userName" type="text" name="userName" required value="<?= $this->msg->userName ?>">

            <p data-name="userName"></p>
        </div>
        <div>
            <label for="userEmail">E-mail адрес *:</label>
            <br/>
            <input id="userEmail" type="email" name="userEmail" required value="<?= $this->msg->userEmail ?>">

            <p data-name="userEmail"></p>
        </div>
        <div>
            <label for="password">Пароль *:</label>
            <br/>
            <input id="password" type="password" name="password" required value="">

            <p data-name="password"></p>
        </div>
        <div>
            <label for="passwordConfirm">Пароль (подтверждение) *:</label>
            <br/>
            <input id="passwordConfirm" type="password" name="passwordConfirm" required value="">

            <p data-name="passwordConfirm"></p>
        </div>
        <div>
            <label for="captcha">Защита от роботов *:</label>

            <div>
                <div>
                    <span><img src="<?= BaseController::url('captcha') ?>"/></span>
                    <input id="captcha" name="captcha" placeholder="Введите ответ" type="text" required>
                </div>
                <p data-name="captcha"></p>
            </div>
        </div>
        <div>
            <input type="submit" name="submit" id="submit" value="Регистрация">
        </div>
    </form>
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