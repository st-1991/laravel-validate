<?php

namespace LaravelValidate\Validate;
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
        foreach ($this->rules as $param => $rule) {
            if (in_array($param, $ignore_params)) {
                continue;
            }
            if (!isset($this->validator->getData()[$param])) {
                if (is_array($rule)) {
                    if (!in_array('required', $rule)) {
                        continue;
                    }
                } else {
                    if (!strpos('required', $rule)) {
                        continue;
                    }
                }
            }
            $values[$param] = $this->validator->getData()[$param] ?? '';
        }
        return $values;
    }

    public function getValidate()
    {
        return $this->validator;
    }
}
