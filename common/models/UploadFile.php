<?php

namespace common\models;

use Yii;
use yii\base\Model;

class UploadFile extends Model
{
    public $file;

    private $filePath;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'uploadRequired' => 'Будь ласка, виберіть файл для завантаження', 'extensions' => 'docx', 'wrongExtension' => 'Підтримуються файли наступних разширень: *.docx']
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Завантажити документ'
        ];
    }

    public function upload()
    {
        $name = Yii::$app->security->generateRandomString();
        $this->filePath = Yii::$app->basePath . '/web/uploads/' . $name . '.' . $this->file->extension;
        $this->file->saveAs($this->filePath);

        $file_content = $this->parseDocx();

        $this->remove();

        return $file_content;
    }

    private function remove()
    {
        unlink($this->filePath);
    }

    private function parseDocx()
    {
        $content = '';
        $text = '';

        $zip = zip_open($this->filePath);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $content;
    }
}