<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Albums;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php   // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Upload Images', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create New Album', ['albums/create'], ['class' => 'btn btn-success']) ?>
        <!-- <button onclick='deleteimage()' class='btn btn-delete']>Delete</button> -->
    </p>


<?php Pjax::begin(); 
$names = Albums::find()->asArray()->all();  
$featured = [
    ['id' => 0, 'name' => 'No'],
    ['id' => 1, 'name' => 'Yes'],
]
?>  
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'imageUrl',
                'label' => 'Image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads/'. $data['imageUrl'],
                        ['width' => '70px']);
                },
            ],
            [
                'attribute' => 'imageUrl',
                'label' => 'Image Name',
            ],
            [
                'attribute' => 'albums_id',
                'label' => 'Albums',
                'value' => function($data){
                    return $data->albums_id == $data->albums->id? $data->albums->name : "";
                },
                'filter' => Arrayhelper::map($names, 'id', 'name'),
            ],
            [
                'attribute' => 'featured',
                'label'     => 'Featured?',
                'value' =>function($data) {
                    return $data->featured == 0 ? 'No' : 'Yes';
                },
                'filter' => Arrayhelper::map($featured, 'id', 'name'),
            ],
            [
                'attribute' => 'time',
                'format' => 'datetime',
                'label' => 'Publish Date'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
