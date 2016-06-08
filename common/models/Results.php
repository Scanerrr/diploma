<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "results".
 *
 * @property integer $id
 * @property integer $mark
 * @property integer $owner_id
 * @property integer $test_id
 *
 * @property Tests $test
 * @property User $owner
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark', 'owner_id', 'test_id'], 'integer'],
            [['owner_id', 'test_id'], 'required'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
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
            'mark' => 'Mark',
            'owner_id' => 'Owner ID',
            'test_id' => 'Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
