<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Documents[] $documents
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            [['name'], 'required', 'message' => 'Поле не може бути порожнім'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Назва предмету',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['subject_id' => 'id']);
    }
}
