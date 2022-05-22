<?php

namespace PMVC\PlugIn\get;

use PMVC\TestCase;

const emptyOrder = ['order' => []];

class GetTest extends TestCase
{
    private $_plug = 'get';
    public function testPlugin()
    {
        ob_start();
        print_r(\PMVC\plug($this->_plug, emptyOrder));
        $output = ob_get_contents();
        ob_end_clean();
        $this->haveString($this->_plug, $output);
    }

    /**
     * @expectedException        UnexpectedValueException
     * @expectedExceptionMessage should not pass key with null
     */
    public function testGetNullKey()
    {
        $get = \PMVC\plug($this->_plug, emptyOrder);
        $this->willThrow(function () use ($get) {
            $get->get(null);
        }, false);
    }
}
