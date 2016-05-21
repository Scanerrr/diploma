<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

class DocumentsSearch extends Documents
{
    public $username;
    public $subject_name;
    public $document_type;

    public function rules()
    {
        return [
            [['name', 'username', 'subject_name', 'document_type'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Documents::find()
            ->joinWith(['user', 'subjects', 'document_types']);

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

        $dataProvider->sort->attributes['document_type'] = [
            'asc' => ['document_types.name' => SORT_ASC],
            'desc' => ['document_types.name' => SORT_DESC],
        ];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andWhere('documents.name LIKE "%' . $this->name . '%" ');

        $query->andWhere('user.name LIKE "%' . $this->username . '%" ');

        $query->andWhere('subjects.name LIKE "%' . $this->subject_name . '%" ');

        $query->andWhere('document_types.name LIKE "%' . $this->document_type . '%" ');


        return $dataProvider;

    }

}