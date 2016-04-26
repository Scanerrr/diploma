<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            [['name', 'text'], 'required'],
            [['text'], 'string', 'min' => '1'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название лекции',
            'text' => 'Содержимое лекции',
        ];
    }

}
