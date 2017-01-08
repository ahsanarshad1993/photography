<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Images;

/**
 * ImagesSearch represents the model behind the search form about `app\models\Images`.
 */
class ImagesSearch extends Images
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'featured', 'albums_id'], 'integer'],
            [['imageUrl', 'time'], 'safe'],
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
        $query = Images::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'featured' => $this->featured,
            'albums_id' => $this->albums_id,
        ]);

        $query->andFilterWhere(['like', 'imageUrl', $this->imageUrl]);

        return $dataProvider;
    }    

    public function featuredsearch()
    {
        $query = Images::find();

        // add conditions that should always apply here
        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM images WHERE featured = 1')->queryScalar();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->from('images')->where(['featured' => 1]),
            'pagination' => [
                'pageSize' => $count,
            ],
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'featured' => $this->featured,
            'albums_id' => $this->albums_id,
        ]);

        $query->andFilterWhere(['like', 'imageUrl', $this->imageUrl]);

        return $dataProvider;
    }

    public function albumwisesearch($id){

        $query = Images::find();

        // add conditions that should always apply here
        $count = Yii::$app->db->createCommand( 'SELECT COUNT(*) FROM images WHERE albums_id = "$id"')->queryScalar();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->from('images')->where(['albums_id' => $id]),
            'pagination' => [
                'pageSize' => $count,
            ],
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'featured' => $this->featured,
            'albums_id' => $this->albums_id,
        ]);

        $query->andFilterWhere(['like', 'imageUrl', $this->imageUrl]);

        return $dataProvider;

    }

    public function albumcoversearch(){

        $query = Images::find();


        $albumsid = Yii::$app->db->createCommand( 'SELECT id FROM albums')->queryAll();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->from('images'),
        ]);
        // print_r($dataProvider);
        // var_dump($dataProvider);

        // die();
        return $dataProvider;
    }
}
