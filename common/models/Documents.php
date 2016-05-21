<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "documents".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $owner_id
 * @property integer $subject_id
 *
 * @property User $owner
 * @property Subjects $subject
 */
class Documents extends ActiveRecord
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
            [['name', 'text', 'owner_id', 'subject_id', 'type_id'], 'required', 'message' => 'Поле не може бути порожнім'],
            [['text'], 'string'],
            [['owner_id', 'subject_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentTypes::className(), 'targetAttribute' => ['type_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва лекії',
            'text' => 'Зміст лекції',
            'owner_id' => "Ім'я викладача",
            'subject_id' => 'Назва предмету',
            'type_id' => 'Тип документу'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }

    public function getDocument_types()
    {
        return $this->hasOne(DocumentTypes::className(), ['id' => 'type_id']);
    }

    public static function getOwnerNameByID($id)
    {
        return User::find()->select('name')->where(['id' => $id])->asArray()->one();
    }

    public static function getNext($id)
    {
        return Documents::find()->where('id > ' . $id)->min('id');
    }

    public static function getPrev($id)
    {
        return Documents::find()->where('id < ' . $id)->max('id');
    }

}
