<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payment */
/* @var $form yii\widgets\ActiveForm */

echo 'Назначение плаnежа: ' . $payment[1]->purpose . "<br>";
echo 'Цена: ' . ($payment[1]->price) . 'р' . "<br>";
echo 'Дата: ' . date('H:m d-m-Y ', $payment[1]->date) . "<br>" . "<br>";
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $payment[0] . "<br>" ?>
    <?= $form->field($model, 'card_num')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Оплатить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
