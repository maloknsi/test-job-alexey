<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
	'id' => 'order-form',
	'enableAjaxValidation' => true,
	'enableClientValidation' => false,
	'action' => ['save', 'id' => $model->id],
	'validationUrl' => ['validate', 'id' => $model->id],
	'options' => ['enctype' => 'multipart/form-data', 'class' => 'modal-active-form'],
]); ?>
<div class="portlet-body">
	<div class="panel">
		<div class="panel panel-info">
			<div class="panel-heading">Пользователь</div>
			<div class="panel-body">
				<div class="col-xs-12">
					<?= $form->field($model, 'user_id')->textInput() ?>
					<?= $form->field($model, 'service_id')->textInput() ?>
					<?= $form->field($model, 'numb_serial')->textInput() ?>
					<?= $form->field($model, 'box')->textInput() ?>
					<?= $form->field($model, 'code')->textInput() ?>
					<?= $form->field($model, 'degree_wear')->textInput() ?>
					<?= $form->field($model, 'defects')->textarea(['rows' => 6]) ?>
					<?= $form->field($model, 'warning')->textarea(['rows' => 6]) ?>
					<?= $form->field($model, 'date_receipt')->textInput() ?>
					<?= $form->field($model, 'date_issue')->textInput() ?>
					<?= $form->field($model, 'status')->textInput() ?>
					<?= $form->field($model, 'pay_type')->textInput() ?>
					<?= $form->field($model, 'pay_status')->textInput() ?>
					<?= $form->field($model, 'shipment')->textInput() ?>
					<?= $form->field($model, 'price')->textInput() ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12 ">
			<?= $form->errorSummary($model); ?>
		</div>
	</div>
	<div class="modal-footer">
		<div class="form-group">
			<?= $form->field($model, 'id', [
				'options' => ['tag' => false],
				'errorOptions' => [],
			])->hiddenInput()->label(''); ?>
			<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['value' => Url::to(['edit']), 'title' => 'Подтвердить действие', 'class' => 'showModalButton btn btn-success']); ?>
			<?= Html::button('Закрыть', ['class' => 'btn grey-mint', 'data-dismiss' => "modal"]); ?>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>
