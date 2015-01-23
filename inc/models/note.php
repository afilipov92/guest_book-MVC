<?php

class NoteModel extends Model {
    public $title = "";
    public $description = "";
    public $text = "";
    public $date;
    public $id_author;

    /**
     * устанавливает текущую дату и время
     */
    public function __construct() {
        $this->date = date('Y-m-d H:i:s');
    }

    /**
     * проверка валидности формы
     * @return bool
     */
    public function isFormValid() {
        $this->errors = array();

        if (strlen($this->title) < 5) {
            $this->errors['title'] = 'Название должно быть от 5 символов';
        }

        if (strlen($this->description) < 20) {
            $this->errors['description'] = 'Описание должно быть от 20 символов';
        }

        if (strlen($this->text) < 50) {
            $this->errors['text'] = 'Текст должен быть от 50 символов';
        }

        return empty($this->errors);
    }

    /**
     * сохраняет данные из формы в базу данных
     * @return bool
     */
    public function insertNote() {
        $ins = self::db()->prepare('INSERT INTO ' . DB_PREFIX . 'notes (title, description, text, date, id_author) VALUES (:title, :description, :text, :date, :id_author)');
        return $ins->execute(array(
            'title' => $this->title,
            'description' => $this->description,
            'text' => $this->text,
            'date' => $this->date,
            'id_author' => $this->id_author
        ));
    }

    /**
     * Возвращает данные для данной страницы
     * @param int $pageNum
     * @param int $pageSize
     * @return array
     */
    public function getItemsForPage($pageNum = 1, $pageSize = PAGE_SIZE) {
        $num = ($pageNum - 1) * $pageSize;
        $mas = self::db()->query("SELECT * FROM " . DB_PREFIX . "notes ORDER BY date DESC LIMIT $num, $pageSize", PDO::FETCH_CLASS, 'MessageGBModel')->fetchAll();
        return $mas;
    }
}