<?php

namespace SunTao\Validate;
use Illuminate\Validation\Validator;

class ValidateValues
{
    protected $validator;
    protected $rules;

    public function __construct(Validator $validator, array $rules)
    {
        $this->validator = $validator;
        $this->rules = $rules;
    }

    public function getValidateValue(array $ignore_params = []):array
    {
        if (empty($ignore_params)) {
            $ignore_params = config('validate.ignore_params');
        } else {
            $ignore_params = array_merge($ignore_params, config('validate.ignore_params'));
        }
        $values = [];
        foreach (array_keys($this->rules) as $key) {
            if (in_array($key, $ignore_params)) {
                continue;
            }
            $values[$key] = $this->validator->getData()[$key] ?? '';
        }
        return $values;
    }

    public function getValidate()
    {
        return $this->validator;
    }
}
