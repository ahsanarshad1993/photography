<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Albums;
//use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model app\models\Images */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">
    
    <?php echo \kato\DropZone::widget([
       'options' => [
            'url' => 'index.php?r=images/upload',
            'paramName' => 'file',
            'maxFilesize' => '9000',

            //'acceptedFiles' => '.jpg',
            // 'addRemoveLinks' => true,
       ],
       'clientEvents' => [
           'complete' => "function(file){ fileupload(myDropzone.getAcceptedFiles());}",
           'removedfile' => "function(file){alert(file.name + ' is removed'); fileupload(myDropzone.getAcceptedFiles());}"
       ],
    ]);
    ?>

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

</div>


