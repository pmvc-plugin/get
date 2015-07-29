<?php
namespace PMVC\PlugIn\get;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\Get';

function get($k)
{
    return \PMVC\plug('get')->get($k);
}

class Get extends \PMVC\PlugIn
{
    public function get($k)
    {
        $option = \PMVC\getOption($k);
        if (!is_null($option)) {
            return $option;
        } else {
            foreach ($this['order'] as $get) {
                if (\PMVC\plug($get)->isset($k)) {
                    return \PMVC\plug($get)->get($k);
                }
            }
        }
        return $option;
    }
}
