<?php

namespace PMVC\PlugIn\get;

use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\get';

const GET_ORDER = 'order';

class get extends PlugIn
{
    public function get($k, $default = null)
    {
        $result =& \PMVC\getOption($k);
        if (is_null($result)) {
            foreach ($this[GET_ORDER] as $get) {
                $plug = \PMVC\plug($get);
                if ($plug && $plug->has($k)) {
                    $result = $plug->get($k);
                    break;
                }
            }
            if (is_null($result)) {
                if (is_callable($default)) {
                    $default = call_user_func($default);
                }
                $result = $default;
            }
            if (!is_null($result)) {
                \PMVC\option('set', $k, $result);
            }
        }
        return $result;
    }

    public function init()
    {
        if (!is_array($this[GET_ORDER])) {
            $this->unexpected_order_value_exception($this[GET_ORDER]); 
        }
        \PMVC\l(__DIR__.'/src/GetInterface.php');
    }

    public function offsetSet($k, $v)
    {
        if ($k === GET_ORDER && !is_array($v)) {
            $this->unexpected_order_value_exception($v); 
        } 
        return parent::offsetSet($k, $v);
    }
}
