<?php

class File {
    const uploaddir = 'C:/files/';
    public $uploadfile;

    /**
     * рассположение загруженного файла
     */
    public function  __construct() {
        $this->uploadfile = self::uploaddir . basename($_FILES['filename']['name']);
    }

    /**
     * чтение и отпрвка файла
     * @param $file
     */
    public static function save($file){
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Content-Length: " . strlen($file));
        header("Content-Disposition: attachment; filename= *.xml");
        if ($fd = fopen($file, 'rb')) {
            while (!feof($fd)) {
                print fread($fd, 1024);
            }
            fclose($fd);
        }
        exit;
    }

    /**
     * перемещает загруженный файл в новое место
     * @return bool
     */
    public  function upload() {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $this->uploadfile)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * проверяет валидность xml, используя xsd-схему
     * @return bool
     */
    public function isValid() {
        $xml = new DOMDocument();
        $xml->load($this->uploadfile);
        if (!$xml->schemaValidate('schema.xsd')) {
            unlink($this->uploadfile);
            return false;
        } else {
            return true;
        }
    }

    /**
     * возвращает XML дерево в виде строки
     * @param array $mas
     * @return string
     */
    public static function getXml(array $mas) {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $messages = $dom->appendChild($dom->createElement('messages'));
        foreach ($mas as $a) {
            $message = $messages->appendChild($dom->createElement("message"));
            foreach ($a as $key => $val) {
                $property = $message->appendChild($dom->createElement($key));
                $key == 'messageText' ? $property->appendChild($dom->createCDATASection($val)) : $property->appendChild($dom->createTextNode($val));
            }
        }
        return $dom->saveXML();
    }
}