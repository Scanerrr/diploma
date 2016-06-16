<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

class ResultsSearch extends Results
{
    public $username;
    public $name;

    public function rules()
    {
        return [
            [['username', 'name', 'mark'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Results::find()
            ->joinWith(['owner', 'test']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 50,
            ],
        ]);

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['tests.name' => SORT_ASC],
            'desc' => ['tests.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['mark'] = [
            'asc' => ['results.mark' => SORT_ASC],
            'desc' => ['results.mark' => SORT_DESC],
        ];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andWhere('tests.name LIKE "%' . $this->name . '%" ');

        $query->andWhere('user.name LIKE "%' . $this->username . '%" ');

        $query->andWhere('results.mark LIKE "%' . $this->mark . '%" ');


        return $dataProvider;

    }

}