# yii2-dadata-suggestions-widget

[![Latest Version](https://img.shields.io/github/tag/corpsepk/yii2-dadata-suggestions-widget.svg?style=flat-square&label=release)](https://github.com/corpsepk/yii2-dadata-suggestions-widget/tags)
[![Build Status](https://img.shields.io/travis/corpsepk/yii2-dadata-suggestions-widget/master.svg?style=flat-square)](https://travis-ci.org/corpsepk/yii2-dadata-suggestions-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/corpsepk/yii2-dadata-suggestions-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/corpsepk/yii2-dadata-suggestions-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/corpsepk/yii2-dadata-suggestions-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/corpsepk/yii2-dadata-suggestions-widget)

Wrapper for [DaData](https://dadata.ru/suggestions/)'s jQuery plugin

## Installation

### 1. Download
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run the following command:

```bash
$ composer require corpsepk/yii2-dadata-suggestions-widget:~0.3
```

### 2. Get api key
Register at [DaData.ru](https://dadata.ru/profile/#info), and get api key.

### 3. Configure (optional)
You can setup container definitions if you do not want to enter api key in every widget.
Add following lines to your main configuration file:

```php
'container' => [
    'definitions' => [
        'corpsepk\DaData\SuggestionsWidget' => [
            'token' => 'my-dadata-api-key',
        ],
    ],
],
```

## Usage

```php
use corpsepk\DaData\SuggestionsWidget;
```

```php
<?= SuggestionsWidget::widget([
    'model' => $model,
    'attribute' => 'inn',
    'token' => 'your apiKey'
]) ?>
```
The following example will use the name property instead:
```php
<?= SuggestionsWidget::widget([
    'name' => 'inn',
    'token' => 'your apiKey'
]) ?>
```
You can also use this widget in an `yii\widgets\ActiveForm` using the `yii\widgets\ActiveField::widget()`
method, for example like this:
```php
<?= $form->field($model, 'inn')->widget(SuggestionsWidget::class, [
    'token' => 'your apiKey'
]) ?>
```

## Useful links

- DaData - https://dadata.ru
- jQuery plugin options - https://confluence.hflabs.ru/pages/viewpage.action?pageId=466681916
- Hints - https://dadata.userecho.com/topics/2090


## Testing

```bash
$ ./vendor/bin/phpunit
```
