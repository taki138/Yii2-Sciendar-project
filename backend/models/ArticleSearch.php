<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
// use backend\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'userEmailFilter', 'description'], 'safe'],
            ['createdAtFilter', 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'created_at'],
            ['updatedAtFilter', 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'updated_at'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = Article::find()->innerJoinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort(['attributes' => [
            'id',
            'title',
            'description',
            'createdAt' => [
                'asc'  => ['article.created_at' => SORT_ASC],
                'desc' => ['article.created_at' => SORT_DESC],
            ],
            'updatedAtFilter' => [
                'asc'  => ['article.updated_at' => SORT_ASC],
                'desc' => ['article.updated_at' => SORT_DESC],
            ],
            'userEmailFilter' => [
                'asc'  => ['user.email' => SORT_ASC],
                'desc' => ['user.email' => SORT_DESC],
            ],
        ]]);

        if ( !$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere([
            // 'id'      => $this->id,
            // 'user_id' => $this->user_id,
            'like', 'article.id', $this->id.'%', false
        ])
            ->andFilterWhere(['user_id' => $this->user_id])
        ;

        // фильтр по дате создания
        if ($this->created_at) {
            $query->andWhere(['and',
                ['>', 'article.created_at', $this->created_at],
                ['<=', 'article.created_at', $this->created_at + 60 * 60 * 24],
            ]);
        }

        // Фильтр по дате сортировки
        if ($this->updated_at) {
            $query->andWhere(['and',
                ['>', 'article.updated_at', $this->updated_at],
                ['<=', 'article.updated_at', $this->updated_at + 60 * 60 * 24],
            ]);
        }

        $query
            ->andFilterWhere(['like', 'title', '%'.$this->title.'%', false])
            ->andFilterWhere(['like', 'description', '%'.$this->description.'%', false])
            ->andFilterWhere(['like', 'user.email', '%'.$this->userEmailFilter.'%', false])
        ;

        return $dataProvider;
    }
}
