<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AlbumsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albums-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    
    
    <div>
        <?php // print_r($dataProvider->models[0]['id']); ?>
        <?php //print_r($imageDataProvider->models[0]['id']); ?>
    <div class="row">
        <?php foreach ($dataProvider->models as $model) { ?>
            <?php foreach ($imageDataProvider->models as $modeli) { ?>
                <?php if($model['id'] == $modeli['albums_id']){?>
                    <a href="<?=Yii::getAlias('@web').'/index.php?r=albums/displayone&id='. $model['id']?>">
                       <div class="col-md-4">
                            <?= Html::img(Yii::getAlias('@web').'/uploads/'. $modeli['imageUrl'], ['width' => '100%'], ['height' => '100%']); ?>
                            <span class="thumb-caption"><?= $model['name'] ?></span>
                       </div>
                    </a>
                <?php break; } ?>
            <?php } ?>
        <?php } ?>
    </div>
    </div>


<?php Pjax::end(); ?></div>
