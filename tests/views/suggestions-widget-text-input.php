<?php
use \corpsepk\DaData\SuggestionsWidget;

/* @var $this yii\web\View */
/* @var $model tests\models\Model */

// TODO test - с ActiveForm
// TODO test - Token required

echo SuggestionsWidget::widget([
    'model' => $model,
    'attribute' => 'name',
]);

echo SuggestionsWidget::widget([
    'name' => 'name',
]);

echo SuggestionsWidget::widget([
    'id' => 'widget-id',
    'name' => 'name',
]);

echo SuggestionsWidget::widget([
    'name' => 'name',
]);