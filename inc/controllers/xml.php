<?php

class XmlController extends BaseController {
    /**
     * экспортирует данные из базы данных в файл
     * и предлагет сохранить их
     */
    public function exportAction() {
        if ($this->isPost()) {
            $file = BaseController::url('xml', 'qxml');
            File::save($file);
        }
        $this->view->contain('xml/export');
    }

    /**
     * импортирует данные из выбранного файла в базу данных
     */
    public function importAction() {
        if ($this->isPost()) {
            $file = new File();
            if ($file->upload()) {
                if ($file->isValid()) {
                    $messages = simplexml_load_file($file->uploadfile);
                    $gb = new MessageGBModel();

                    $gb->deleteMessages();

                    $gb->importMessages($messages);
                }
            }
        }
        $this->view->contain('xml/import');
    }

    /**
     * генерирует xml
     */
    public function setxmlAction() {
        $gb = new MessageGBModel();
        echo FILE::getXml($gb->getItems());
    }
}