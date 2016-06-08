<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property integer $id
 * @property string $name
 * @property integer $owner_id
 *
 * @property Questions[] $questions
 * @property Results[] $results
 * @property User $owner
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'owner_id'], 'required', 'message' => '{attribute} не може бути порожнім'],
            [['owner_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва тесту',
            'owner_id' => 'Користувач',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
