<?php

class MessageGBModel extends Model {
    public $userName = "";
    public $userEmail = "";
    public $messageText = "";
    public $date;
    protected $errors;

    public function __construct() {
        parent::__construct();
        $this->date = date('Y-m-d H:i:s');
    }

    /**
     * проверка валидности данных
     * @return bool
     */
    public function isFormVaild() {
        $this->errors = array();

        if (preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{5,20}$/', $this->userName) == 0) {
            $this->errors['userName'] = 'Проверьте ввод имени';
        }

        if (preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $this->userEmail) == 0) {
            $this->errors['userEmail'] = 'Проверьте ввод email';
        }

        if (strlen($this->messageText) < 50) {
            $this->errors['messageText'] = 'Сообщение должно содержать от 50 символов';
        }
        return !empty($this->errors);
    }

    /**
     * сохраняет данные из формы в базу данных
     * @return bool
     */
    public function insertMessage() {
        $ins = $this->db->prepare('INSERT INTO ' . DB_PREFIX . 'gb_messages (userName, userEmail, messageText, date) VALUES (:userName, :userEmail, :messageText, :date)');
        return $ins->execute(array(
            'userName' => $this->userName,
            'messageText' => $this->messageText,
            'userEmail' => $this->userEmail,
            'date' => $this->date
        ));
    }

    /**
     * Возвращает данные для данной страницы
     * @param $pageNum
     * @param $pageSize
     * @return array
     */
    public function getItemsForPage($pageNum = 1, $pageSize = PAGE_SIZE){
        $num = ($pageNum - 1) * $pageSize;
        $mas = $this->db->query("SELECT userName AS '_userName', userEmail AS '_userEmail', messageText, date, userIP, userBrowser FROM guest_book ORDER BY date DESC LIMIT $num, $pageSize", PDO::FETCH_ASSOC)->fetchAll();
        return $mas;
    }
}