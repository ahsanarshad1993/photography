<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Albums */

$this->title = $model->name;
?>

<?php
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['display']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="albums-view">

  

    <div id="mygallery" class="justified-gallery">
        <?php foreach ($dataProvider->models as $model) { ?>
            <a href="<?=Yii::getAlias('@web').'/uploads/'. $model['imageUrl']?>" data-lightbox="featured">
                <?=
                Html::img(Yii::getAlias('@web').'/uploads/'. $model['imageUrl']);
                ?>
            </a>
        <?php } ?>
    </div>

</div>
