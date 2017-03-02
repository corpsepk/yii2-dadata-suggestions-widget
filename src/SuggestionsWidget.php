<?php

namespace corpsepk\DaData;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;

/**
 * SuggestionsWidget widget is a Yii2 wrapper for the DaData Suggestions jQuery plugin.
 *
 * ```php
 * echo SuggestionsWidget::widget([
 *     'model' => $model,
 *     'attribute' => 'inn',
 *     'token' => 'your apiKey'
 * ]);
 * ```
 *
 * The following example will use the name property instead:
 *
 * ```php
 * echo SuggestionsWidget::widget([
 *     'name' => 'inn',
 *     'token' => 'your apiKey'
 * ]);
 * ```
 *
 * You can also use this widget in an [[yii\widgets\ActiveForm|ActiveForm]] using the [[yii\widgets\ActiveField::widget()|widget()]]
 * method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'inn')->widget(\corpsepk\SuggestionsWidget::classname(), [
 *     'token' => 'your apiKey'
 * ]) ?>
 * ```
 *
 * Параметры jQuery плагина
 * @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=466681916
 *
 * @author Alexsandr Khramov <corpsepk@gmail.com>
 * @see https://github.com/corpsepk/...
 */
class SuggestionsWidget extends InputWidget
{
    const TYPE_NAME = 'NAME';
    const TYPE_ADDRESS = 'ADDRESS';
    const TYPE_PARTY = 'PARTY';
    const TYPE_BANK = 'BANK';
    const TYPE_EMAIL = 'EMAIL';

    /**
     * @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=466681917
     */
    const CALLBACK_BEFORE_RENDER = 'beforeRender';
    const CALLBACK_FORMAT_RESULT = 'formatResult';
    const CALLBACK_FORMAT_SELECTED = 'formatSelected';
    const CALLBACK_ON_VALIDATE_SELECTION = 'onInvalidateSelection';
    const CALLBACK_ON_SEARCH_START = 'onSearchStart';
    const CALLBACK_ON_SEARCH_COMPLETE = 'onSearchComplete';
    const CALLBACK_ON_SEARCH_ERROR = 'onSearchError';
    const CALLBACK_ON_SUGGESTION_FETCH = 'onSuggestionsFetch';
    const CALLBACK_ON_SELECT = 'onSelect';
    const CALLBACK_ON_SELECT_NOTHING = 'onSelectNothing';

    /**
     * @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=466681916
     */
    const ADDON_SPINNER = 'spinner';
    const ADDON_CLEAR = 'clear';
    const ADDON_NONE = 'none';

    /**
     * Тип подсказок:
     * NAME — ФИО;
     * ADDRESS — адреса;
     * PARTY — организации и ИП;
     * EMAIL — адрес электронной почты;
     * BANK — банковские организации.
     * @var string
     */
    public $type;

    /**
     * Тип подсказок по умолчанию
     * @var string
     */
    public $defaultType = self::TYPE_NAME;

    /**
     * @var array
     */
    public $inputOptions = [];

    /**
     * API-ключ вашей учетной записи на DaData.ru.
     * Можно посмотреть в личном кабинете - https://dadata.ru/profile/#info
     * @var string
     */
    public $token;

    /**
     * Что показывать в правом углу текстового поля подсказок:
     * по умолчанию — индикатор загрузки в десктопной версии и крестик очистки в мобильной;
     * spinner — индикатор загрузки;
     * clear — крестик очистки;
     * none — ничего не показывать.
     * Обратите внимание, значение нужно передавать как строку (например, addon: "clear").
     * @var string
     */
    public $addon;

    /**
     * Всегда выбирать первую подсказку, если пользователь явно не выбрал другую.
     * default - false
     * @var bool
     */
    public $autoSelectFirst;

    /**
     * Максимальное количество подсказок в выпадающем списке. Не может быть больше 20.
     * default - 5
     * @var int
     */
    public $count;

    /**
     * Период ожидания перед отправкой запроса на сервер подсказок, в миллисекундах.
     * Позволяет не перегружать сервер запросами, если пользователь очень быстро печатает.
     * default - 100
     * @var int
     */
    public $deferRequestBy;

    /**
     * Если опция установлена в true,
     * выпадающий список отображается поверх всего документа, и ничем не обрезается.
     * default - false
     * @var bool
     */
    public $floating;

    /**
     * Объект с дополнительными HTTP-заголовками, которые необходимо передать на сервер.
     * @var string
     */
    public $headers;

    /**
     * Поясняющий текст, который показывается в выпадающем списке над подсказками.
     * @var string
     */
    public $hint;

    /**
     * Периодическая проверка, не стали ли невидимые поля видимыми (время в миллисекундах).
     * default - 100
     * @var int
     */
    public $initializeInterval;

    /**
     * Минимальная длина текста, после которой включаются подсказки.
     * @var int
     */
    public $minChars;

    /**
     * Максимальная ширина экрана, при которой будет применен вид,
     * адаптированный для мобильных устройств.
     * default - 980
     * @var int
     */
    public $mobileWidth;

    /**
     * Кэширование ответов сервера.
     * default - false
     * @var bool
     */
    public $noCache;

    /**
     * Прокрутка поля ввода к верхнему краю экрана при фокусе. Для мобильных устройств.
     * Если передать jQuery-объект с другим элементом, страница будет прокручиваться до этого элемента.
     * default - true
     * @var bool
     */
    public $scrollOnFocus;

    /**
     * URL сервиса standalone-подсказок.
     * @var
     */
    public $serviceUrl;

    /**
     * Не показывать подсказки до ввода символа "@" в подсказках по e-mail.
     * default - true
     * @var bool
     */
    public $suggest_local;

    /**
     * Таймаут для отправки ajax-запросов на сервер. Указывается в миллисекундах.
     * default - 3000
     * @var integer
     */
    public $timeout;

    /**
     * Автоматически подставлять подходящую подсказку из списка при потере фокуса.
     * default - true
     * @var bool
     */
    public $triggerSelectOnBlur;

    /**
     * Автоматически подставлять подходящую подсказку из списка при нажатии на Enter.
     * default - true
     * @var bool
     */
    public $triggerSelectOnEnter;

    /**
     * Автоматически подставлять подходящую подсказку из списка
     * при нажатии на пробел (по умолчанию отключено).
     * default - false
     * @var bool
     */
    public $triggerSelectOnSpace;

    /**
     * Ширина выпадающего списка в пикселях. 'auto' - по ширине текстбокса.
     * default - auto
     * @var string|int
     */
    public $width;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        $this->initInputOptions();
    }

    protected function initOptions()
    {
        if (!$this->type) {
            $this->type = $this->defaultType;
        }

        $attributes = [
            'addon',
            'autoSelectFirst',
            'count',
            'deferRequestBy',
            'floating',
            'headers',
            'hint',
            'initializeInterval',
            'minChars',
            'mobileWidth',
            'noCache',
            'scrollOnFocus',
            'serviceUrl',
            'suggest_local',
            'timeout',
            'token',
            'triggerSelectOnBlur',
            'triggerSelectOnEnter',
            'triggerSelectOnSpace',
            'type',
            'width',
        ];
        foreach ($attributes as $attribute) {
            if ($this->$attribute === null || isset($this->options[$attribute])) {
                continue;
            }

            $this->options[$attribute] = $this->$attribute;
        }

        // `type` required
        if (!$this->options['type']) {
            throw new InvalidConfigException('`type` required');
        }

        // `token` required
        if (!$this->options['token']) {
            throw new InvalidConfigException('`token` required');
        }
    }

    protected function initInputOptions()
    {
        $this->inputOptions['id'] = $this->options['id'];
        Html::addCssClass($this->inputOptions, 'form-control');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerAssets();
        echo $this->renderWidget();
    }

    /**
     * Renders the SuggestionsWidget widget.
     * @return string the rendering result.
     */
    protected function renderWidget()
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
        } else {
            return Html::textInput($this->name, $this->value, $this->inputOptions);
        }
    }

    /**
     * Registers the needed assets
     */
    protected function registerAssets()
    {
        SuggestionsWidgetAsset::register($this->getView());
        $this->registerPlugin();
    }

    /**
     * Registers plugin
     */
    protected function registerPlugin()
    {
        $id = $this->options['id'];
        $options = empty($this->options) ? '' : Json::htmlEncode($this->options);
        $js = "jQuery('#$id').suggestions($options);";
        $this->getView()->registerJs($js);
    }
}