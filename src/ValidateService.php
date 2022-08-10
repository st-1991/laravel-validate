<?php

namespace LaravelValidate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelValidate\exceptions\ValidateException;
use LaravelValidate\Validate\ValidateInterface;
use LaravelValidate\Validate\ValidateValues;

class ValidateService
{
    public function validation(Request $request, ValidateInterface $validate, array $data = [])
    {
        if (empty($data)) {
            $data = $request->all();
        }
        $validator = Validator::make($data, $validate->rules(), $validate->messages());
        if ($validator->fails()) {
            throw new ValidateException(1702, 'param error', 400, $validator->errors()->first());
        }
        return new ValidateValues($validator, $validate->rules());
    }
}
