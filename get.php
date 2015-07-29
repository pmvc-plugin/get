<?php
namespace PMVC\PlugIn\get;
\PMVC\l(__DIR__.'/src/GetInterface.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\get';

function get($k)
{
    return \PMVC\plug('get')->get($k);
}

class get extends \PMVC\PlugIn
{
    public function get($k)
    {
        $option = \PMVC\getOption($k);
        if (!is_null($option)) {
            return $option;
        } else {
            if (is_array($this['order'])) {
                foreach ($this['order'] as $get) {
                    if (\PMVC\plug($get)->has($k)) {
                        return \PMVC\plug($get)->get($k);
                    }
                }
            }
        }
        return $option;
    }
}
