<?php

namespace common\models;

use CloudConvert\Api;
use Yii;
use yii\base\Model;

class UploadFile extends Model
{
    public $file;
    public $subject_id;
    public $type_id;

    private $filePath;

    public function rules()
    {
        return [
            [['subject_id', 'type_id'], 'integer'],
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
            $filename = $this->online();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } finally {
            $this->remove();
        }

        return $filename;
    }

    public function online()
    {
        $API_KEY = 'neIrEc5qbNWATMEsQlslHg2G9KaYTXfO2T3seGbUAqG96_m1k7QRrjT2IB6ZzOXcNjR9vgIzcmMTKPzY6ziatA';
        $filename = Yii::$app->security->generateRandomString();
        $filename = 'uploads/' . $filename . '.html';

        $api = new Api($API_KEY);

        $api->convert([
            'inputformat' => 'docx',
            'outputformat' => 'html',
            'input' => 'upload',
            'file' => fopen($this->filePath, 'r')
        ])
            ->wait()
            ->download($filename);
        return $filename;
    }

    public function getTheme($filename)
    {
        $theme = '';
        $content = file_get_contents($filename);
        $pattern = '({{(.*)}})';
        $array = [];
        preg_match($pattern, $content, $array);
        if (!empty($array)) {
            $theme = strip_tags($array[1]);
            $content = preg_replace($pattern, '', $content);
            $fs = fopen($filename, 'w');
            fwrite($fs, $content);
            fclose($fs);
        }
        return $theme;
    }

    private function remove()
    {
        unlink($this->filePath);
    }

}