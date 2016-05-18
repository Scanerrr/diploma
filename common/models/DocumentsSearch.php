<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

class DocumentsSearch extends Documents
{
    public $username;
    public $subject_name;

    public function rules()
    {
        return [
            [['name', 'username', 'subject_name'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Documents::find()
            ->joinWith(['user', 'subjects']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 30,
            ],
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['subject_name'] = [
            'asc' => ['subjects.name' => SORT_ASC],
            'desc' => ['subjects.name' => SORT_DESC],
        ];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andWhere('documents.name LIKE "%' . $this->name . '%" ');

        $query->andWhere('user.name LIKE "%' . $this->username . '%" ');

        $query->andWhere('subjects.name LIKE "%' . $this->subject_name . '%" ');


        return $dataProvider;

    }

}