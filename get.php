<?php

namespace PMVC\PlugIn\get;

use PMVC\PlugIn;

\PMVC\l(__DIR__.'/src/GetInterface.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\get';

class get extends PlugIn
{
    public function get($k)
    {
        $option =& \PMVC\getOption($k);
        if (is_null($option)) {
            if (is_array($this['order'])) {
                foreach ($this['order'] as $get) {
                    $plug = \PMVC\plug($get);
                    if ($plug && $plug->has($k)) {
                        $option = $plug->get($k);
                        \PMVC\option('set', $k, $option);
                    }
                }
            } else {
                trigger_error(
                    '[PlugIn:get] should defined order with array. ['.
                    print_r($this['order'], true).
                    ']'
                );
            }
        }
        return $option;
    }
}
