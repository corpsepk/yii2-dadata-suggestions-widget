<?php

namespace corpsepk\DaData;

use yii\web\AssetBundle;

/**
 * TODO добавить возможность грузить ресурсы не только с CDN
 * Asset bundle for SuggestionsWidget
 *
 * @author Alexsandr Khramov <corpsepk@gmail.com>
 */
class SuggestionsWidgetAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public $js = ["https://cdn.jsdelivr.net/jquery.suggestions/16.10/js/jquery.suggestions.min.js"];

    public $css = ["https://cdn.jsdelivr.net/jquery.suggestions/16.10/css/suggestions.css"];
}
