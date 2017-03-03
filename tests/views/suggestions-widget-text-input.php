<?php
use \corpsepk\DaData\SuggestionsWidget;

/* @var $this yii\web\View */
/* @var $model tests\models\Model */

$form = \yii\widgets\ActiveForm::begin([
    'action' => '/',
]);
$form->field($model, 'name')->widget(SuggestionsWidget::className(), [
    'token' => 'apiKey'
]);
\yii\widgets\ActiveForm::end();

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