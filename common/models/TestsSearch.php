<?php
namespace common\models;

use yii\data\ActiveDataProvider;

class TestsSearch extends Tests
{
    public $name;
    public $username;
    public $used;

    public function rules()
    {
        return [
            [['name', 'username', 'used'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Tests::find()
            ->joinWith(['owner', 'results']);

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

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['tests.name' => SORT_ASC],
            'desc' => ['tests.name' => SORT_DESC],
        ];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andWhere('tests.name LIKE "%' . $this->name . '%" ');

        $query->andWhere('user.name LIKE "%' . $this->username . '%" ');


        return $dataProvider;
    }
}