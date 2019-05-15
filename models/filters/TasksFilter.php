<?php

namespace app\models\filters;

use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;

/**
 * TasksFilter represents the model behind the search form of `app\models\tables\Tasks`.
 */
class TasksFilter extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deadline'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tasks::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy('status_id ASC, id DESC'),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'deadline', $this->deadline]);

        $cache = \Yii::$app->cache;
        foreach($dataProvider->getKeys() as $k) {
            $key = 'cacheDataProvider_'.$k;

            if (!$dataProvider = $cache->get($key)) {
                $dependency = new DbDependency();
                $dependency->sql = "SELECT COUNT(id) FROM tasks";

                $dataProvider = new ActiveDataProvider([
                    'query' => $query->orderBy('status_id ASC, id DESC'),
                    'pagination' => [
                        'pageSize' => 9,
                    ],
                ]);
                $cache->set($key, $dataProvider, 3600, $dependency);
            }
        }
        return $dataProvider;
    }
}
