<?php

namespace tests;

use Yii;
use tests\models\Model;
use yii\base\InvalidConfigException;
use corpsepk\DaData\SuggestionsWidget;

/**
 * SuggestionsWidgetTextInputTest
 */
class SuggestionsWidgetTextInputTest extends \PHPUnit_Framework_TestCase
{
    public function testWidget()
    {
        $model = new Model();
        $view = Yii::$app->getView();
        $content = $view->render('//suggestions-widget-text-input', ['model' => $model]);
        $actual = $view->render('//layouts/main', ['content' => $content]);
        $expected = file_get_contents(__DIR__ . '/data/suggestions-widget-text-input.bin');
        $this->assertEquals($expected, $actual);
    }

    public function testTokenRequired()
    {
        $this->setExpectedException(InvalidConfigException::class, '`token` param required');
        SuggestionsWidget::widget([
            'name' => 'inn',
        ]);
    }

    public function testTokenIsSetByDi()
    {
        Yii::$app->setContainer([
            'definitions' => [
                'corpsepk\DaData\SuggestionsWidget' => [
                    'token' => 'my-super-secret-api-key',
                ]
            ]
        ]);

        $actual = SuggestionsWidget::widget([
            'id' => 'sw',
            'name' => 'inn',
        ]);
        $expected = '<input type="text" id="sw" class="form-control" name="inn">';
        $this->assertEquals($expected, $actual);
    }
}