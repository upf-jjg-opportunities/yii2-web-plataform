<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\grid\GridView;

$this->registerJs('jQuery("#form-curriculum-experience").on("pjax:end", function() {jQuery.pjax.reload({container:"#grid-curriculum-experience"})});');
?>

<!--IDIOMA -->
<?php timurmelnikov\widgets\LoadingOverlayPjax::begin(['id' => 'form-curriculum-experience'])?> 
<?php $form = ActiveForm::begin([
    'action'=> ['/curriculum/change/create-experience'],
    'options' => [
        'class' => '',
        'enctype' => 'multipart/form-data',
        'data-pjax' => true
    ],
])?>

<h5>Experiences</h5>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')])->label(false)?>      
    </div> 
    <div class="col-md-6">
        <?= $form->field($model, 'role')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('role')])->label(false)?>
    </div>
</div> 

<div class="row">   
    <div class="col-md-3">
        <?= $form->field($model, 'year_init')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('year_init')])->label(false)?>      
    </div> 
    <div class="col-md-3">
        <?= $form->field($model, 'year_end')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('year_end')])->label(false)?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'finish')->checkbox()?>
    </div>
    <div class="col-md-3">
        <?= Html::submitButton('Add', ['class' => 'btn btn-block btn-outline-success btn-rounded']) ?>
    </div>
</div>
<?php ActiveForm::end()?>
<?php timurmelnikov\widgets\LoadingOverlayPjax::end()?>

<?php timurmelnikov\widgets\LoadingOverlayPjax::begin(['id' => 'grid-curriculum-experience'])?>
<?=GridView::widget([
    'pjax' => true,
    'condensed' => true,
    'showHeader' => false,
    'responsiveWrap' => true,
    'layout' => '{items}',
    'dataProvider' => $model->dataProvider,
    'columns' => $model->gridColumns,
    'tableOptions' => ['class' => 'table-dark'],
])?>    
<?php timurmelnikov\widgets\LoadingOverlayPjax::end() ?>