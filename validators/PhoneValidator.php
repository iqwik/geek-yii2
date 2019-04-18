<?php

namespace app\validators;

use yii\validators\Validator;

class PhoneValidator extends Validator {

    public $pattern = '/^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/';
    public $message = 'Телефон должен быть в формате +7-999-99-99';

    public function init() {
        parent::init();
    }

    public function validateAttribute($model, $attribute) {

        if (!preg_match($this->pattern, $model->$attribute))
            $model->addError($attribute, $this->message);
    }

    public function clientValidateAttribute($model, $attribute, $view) {
        return <<<JS
    if (!$this->pattern.test(value)) {
        messages.push("$this->message");
    } 
JS;
    }
}