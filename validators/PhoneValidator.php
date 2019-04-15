<?php

namespace app\validators;

use yii\validators\Validator;

class PhoneValidator extends Validator {

    public function init() {
        parent::init();
    }

    public function validateAttribute($model, $attribute) {

        if (!preg_match('/^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', $model->$attribute))
            $model->addError($attribute, 'Телефон должен быть в формате +7-999-99-99');
    }

    public function clientValidateAttribute($model, $attribute, $view) {
        return <<<JS
    if (!/^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/.test(value)) {
        messages.push("Телефон должен быть в формате +7-999-99-99");
    } 
JS;
    }
}