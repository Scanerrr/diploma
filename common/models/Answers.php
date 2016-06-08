<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property string $text
 * @property integer $question_id
 * @property integer $isCorrect
 *
 * @property Questions $question
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'question_id'], 'required'],
            [['question_id', 'isCorrect'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'question_id' => 'Question ID',
            'isCorrect' => 'Is Correct',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }
}
