# yii2-dadata-suggestions-widget

Wrapper for [DaData](https://dadata.ru/suggestions/)'s jQuery plugin

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require corpsepk/yii2-dadata-suggestions-widget:~0.1
```

or add

```
"corpsepk/yii2-dadata-suggestions-widget": "~0.1"
```

to the `require` section of your `composer.json` file.

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
You can also use this widget in an [[yii\widgets\ActiveForm|ActiveForm]] using the [[yii\widgets\ActiveField::widget()|widget()]]
method, for example like this:
```php
<?= $form->field($model, 'inn')->widget(SuggestionsWidget::classname(), [
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
