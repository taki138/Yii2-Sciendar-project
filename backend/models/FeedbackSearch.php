<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
// use common\models\Feedback;

/**
 * FeedbackSearch represents the model behind the search form about `common\models\Feedback`.
 */
class FeedbackSearch extends Feedback
{
    public $userEmail;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'rating', 'created_at'], 'integer'],
            [['text', 'userEmail'], 'safe'],
            ['createdAt', 'date', 'format' => 'php:Y.m.d', 'timestampAttribute' => 'created_at'],
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
        $query = Feedback::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort(['attributes' => [
            'id',
            // 'created_at',
            'createdAt' => [
                'asc'  => ['feedback.created_at' => SORT_ASC],
                'desc' => ['feedback.created_at' => SORT_DESC],
            ],
            'text',
            'rating',
            'userEmail' => [
                'asc'  => ['user.email' => SORT_ASC],
                'desc' => ['user.email' => SORT_DESC],
            ]
        ]]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            return $dataProvider;
        }

        $query->andFilterWhere([
            'feedback.id'         => $this->id,
            'user_id'             => $this->user_id,
            // 'feedback.created_at' => $this->created_at,
            'rating'              => $this->rating,
        ]);
        
        if ($this->created_at) {
            $query->andFilterWhere(['and',
                ['>', 'feedback.created_at', $this->created_at],
                ['<', 'feedback.created_at', $this->created_at + 24*60*60],
            ]);
        }

        $query->andFilterWhere(['like', 'text', $this->text])
              ->andFilterWhere(['like', 'user.email', $this->userEmail]);

        return $dataProvider;
    }
}
