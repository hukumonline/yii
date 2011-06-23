<?php

/**
 * JMy97DatePicker class file.
 *
 * @author jerry2801 <jerry2801@gmail.com>
 * @version alpha2
 *
 * A typical usage of JMy97DatePicker is as follows:
 * <pre>
 * $this->widget('application.extensions.my97DatePicker.JMy97DatePicker', array(
 *     'model' => $model,
 *     'attribute' => 'send_start_date',
 *     'options' => array('dateFmt' => 'yyyy-MM-dd'),
 *     'htmlOptions' => array('value' => $model->sendStartDateFormatted),
 * ));
 * </pre>
 */

class JMy97DatePicker extends CWidget
{
    public $model;
    public $attribute;

	public $name;
	public $value;

    public $options;
    public $htmlOptions;

	public $baseUrl;

    public function init()
    {
        if(! isset($this->options['lang']))
            $this->options['lang']=Yii::app()->language;

        $options = CJavaScript::jsonEncode($this->options);
        $this->htmlOptions['onclick'] = strtr('WdatePicker({options});', array('{options}' => $options));

        $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
        $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);

        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($this->baseUrl.'/WdatePicker.js');

    }

    public function run()
    {
        echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
    }
}