<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Albums;

/* @var $this yii\web\View */
/* @var $model app\models\Images */

$this->title = 'Update Image: ' . $model->imageUrl;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->imageUrl, 'url' => ['view', 'id' => $model->id, 'albums_id' => $model->albums_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="images-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
</br>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-inline']]); ?>

        <?= $form->field($model, 'featured')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>
        <div class="form-group">
            <label class="control-label" for="images-albums_id">Album</label>
            <?= Html::activeDropDownList($model, 'albums_id', ArrayHelper::map(Albums::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
        </div>
        <div id="imagearray"></div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'postfile()']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</p>
</div>