<?php

namespace PMVC\PlugIn\get;

use PMVC\PlugIn;

\PMVC\l(__DIR__.'/src/GetInterface.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\get';

class get extends PlugIn
{
    public function get($k, $default = null)
    {
        $result =& \PMVC\getOption($k);
        if (is_null($result)) {
            if (is_array($this['order'])) {
                foreach ($this['order'] as $get) {
                    $plug = \PMVC\plug($get);
                    if ($plug && $plug->has($k)) {
                        $result = $plug->get($k);
                        break;
                    }
                }
            } else {
                trigger_error(
                    '[PlugIn:get] should defined order with array. ['.
                    print_r($this['order'], true).
                    ']'
                );
            }
            if (is_null($result)) {
                $result = $default;
            }
            if (!is_null($result)) {
                \PMVC\option('set', $k, $result);
            }
        }
        return $result;
    }
}
