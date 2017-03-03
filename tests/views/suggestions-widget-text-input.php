<?php
use \corpsepk\DaData\SuggestionsWidget;

/* @var $this yii\web\View */
/* @var $model tests\models\Model */

$form = new \yii\widgets\ActiveForm();
$form->field($model, 'name')->widget(SuggestionsWidget::className(), [
    'token' => 'apiKey'
]);

echo SuggestionsWidget::widget([
    'model' => $model,
    'token' => 'apiKey',
    'attribute' => 'name',
]);

echo SuggestionsWidget::widget([
    'name' => 'name',
    'token' => 'apiKey',
]);

echo SuggestionsWidget::widget([
    'id' => 'widget-id',
    'token' => 'apiKey',
    'name' => 'name',
]);

echo SuggestionsWidget::widget([
    'token' => 'apiKey',
    'name' => 'name',
]);