<?php

namespace PMVC\PlugIn\get;

use UnexpectedValueException;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\UnexpectedKeyException';

class UnexpectedKeyException
{
    public function __invoke()
    {
        $message = '[PlugIn:get] should not pass key with null';
        throw new UnexpectedValueException($message);
    }
}
