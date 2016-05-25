<?php

namespace common\models;

use Yii;
use yii\base\Model;

class UploadFile extends Model
{
    public $file;
    private $file_content;
    private $pictures = [];

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

        try {
            $this->parseDocx();
            $this->getImages();
            $this->setImages();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } finally {
            $this->remove();
        }

        if ($this->saveDocument()) {
            $id = Yii::$app->getDb()->lastInsertID;
            return $id;
        } else {
            return false;
        }

    }

    private function remove()
    {
        unlink($this->filePath);
    }

    private function parseDocx()
    {
        $xml = '';

        $zip = zip_open($this->filePath);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $xml .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);


        $dom = new \DOMDocument();
        $dom->loadXML($xml);


        $elements = $dom->getElementsByTagName('pict');

        if ($elements->length > 0) {
            for ($i = 0; $i < $elements->length; $i++) {
                $elements->item($i)->textContent = "[~$i~]";
            }
        }

        $xml = $dom->saveXML();

        $xml = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $xml);
        $xml = str_replace('</w:r></w:p>', "\r\n", $xml);

        $striped_content = strip_tags($xml);


        return $this->file_content = $striped_content;
    }

    private function getImages()
    {
        /*Create a new ZIP archive object*/
        $zip = new \ZipArchive;
        $pictures = [];
        /*Open the received archive file*/
        if (true === $zip->open($this->filePath)) {
            for ($i = 0; $i < $zip->numFiles; $i++) {


                /*Loop via all the files to check for image files*/
                $zip_element = $zip->statIndex($i);


                /*Check for images*/
                if (preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)", $zip_element['name'], $pictures)) {
                    //found current picture
                    $extension = $pictures[2];
                    $filename = Yii::$app->security->generateRandomString();
                    $fp = fopen('uploads/' . $filename . '.' . $extension, 'w');
                    fwrite($fp, $zip->getFromIndex($i));
                    fclose($fp);

                    $this->pictures[] = '../uploads/' . $filename . '.' . $extension;
                }

            }
        }
        return true;
    }

    private function setImages()
    {
        for ($i = 0; $i <= count($this->pictures); $i++) {
            $pattern = "(\[~$i~\])";
            $tag = "<p><img src='" . $this->pictures[$i] . "' /></p>";
            $this->file_content = preg_replace($pattern, $tag, $this->file_content);
        }

        return $this->file_content;

    }

    private function saveDocument()
    {
        $array = [];
        $pattern = '({{(.+)}})';
        preg_match($pattern, $this->file_content, $array);
        $title = $array[1];
        $this->file_content = preg_replace($pattern, '', $this->file_content);

        $document = new Documents();

        $document->name = $title;
        $document->text = $this->file_content;
        $document->owner_id = intval(Yii::$app->user->getId());
        $document->subject_id = Subjects::find()->select('id')->min('id');
        $document->type_id = 1;
        if ($document->save(false)) {
            Yii::trace('DOCUMENT SAVED');

            return true;
        } else {
            Yii::trace($document->errors);
            return false;
        }

    }

}