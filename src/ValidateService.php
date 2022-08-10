<?php

namespace SunTao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SunTao\exceptions\ValidateException;
use SunTao\Validate\ValidateInterface;
use SunTao\Validate\ValidateValues;

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
