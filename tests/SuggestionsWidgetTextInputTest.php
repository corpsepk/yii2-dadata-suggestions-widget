<?php

namespace tests;

use Yii;
use tests\models\Model;

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

    // TODO test - Token required
}