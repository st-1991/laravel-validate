<?php

namespace SunTao\Validate;

interface ValidateInterface
{
    public function rules() :array;
    public function messages() :array;
}
