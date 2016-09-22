<?php

if (!function_exists('validate')) {
    /**
     * Validate an input against some rules.
     *
     * @param  array $input
     * @param  array $rules
     * @throws \Exception
     * @return void
     */
    function validate($input, $rules)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($input, $rules);

        if ($validator->fails()) {
            $exceptionFactory = app('sedp-mis.model-crud.validation_exception_factory');

            throw $exceptionFactory->make($validator);
        }
    }
}