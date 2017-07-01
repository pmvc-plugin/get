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
        if (!is_null($option)) {
            return $option;
        } else {
            if (is_array($this['order'])) {
                foreach ($this['order'] as $get) {
                    $plug = \PMVC\plug($get);
                    if ($plug && $plug->has($k)) {
                        return $plug->get($k);
                    }
                }
            }
        }
        return $option;
    }
}
