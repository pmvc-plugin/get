<?php

namespace PMVC\PlugIn\get;

use UnexpectedValueException;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\UnexpectedOrderValueException';

class UnexpectedOrderValueException
{
    public function __invoke($order)
    {
        $message = '[PlugIn:get] should defined order with array. ['.
                    print_r($order, true).
                 ']';
        throw new UnexpectedValueException($message);
    }
}
