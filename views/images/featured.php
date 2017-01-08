<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Featured - MUK Photography';

?>
<div class="images-featured">


    
<?php Pjax::begin(); ?>  
    <h1></h1>

    <div id="mygallery" class="justified-gallery">
        <?php foreach ($dataProvider->models as $model) { ?>
            <a href="<?=Yii::getAlias('@web').'/uploads/'. $model['imageUrl']?>" data-lightbox="featured" >
                <?=
                Html::img(Yii::getAlias('@web').'/uploads/'. $model['imageUrl']);
                ?>
            </a>
        <?php } ?>
    </div>



<?php Pjax::end(); ?>



</div>







