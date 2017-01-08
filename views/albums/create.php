<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Albums */

$this->title = 'Create Albums';
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albums-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if ($albumsuccess) {?>
	<div class='alert alert-success'>
		Album Created Successfully!
	</div>
	 <p>
        <?= Html::a('Albums list', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Another Albums', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php }else{?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<?php } ?>
</div>
