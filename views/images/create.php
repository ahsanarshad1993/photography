<?php

use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;


/* @var $this yii\web\View */
/* @var $model app\models\Images */

$this->title = 'Upload Images';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-create">
<h1><?= Html::encode($this->title) ?></h1>
<?php if ($imagesuccess) {?>
    <div class='alert alert-success'>
        Images Uploaded Successfully!
    </div>
<?php }?>
    <p>
        <?= Html::a('Create New Album', ['albums/create'], ['class' => 'btn btn-success']) ?>
    </p>    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
