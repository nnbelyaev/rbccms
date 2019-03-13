<?php

namespace App\Datagrid\Decorator;

class MultiForeign extends Basic
{
    public function render($colValue, array $options)
    {
        $output = '';
        if (strlen($colValue)) {
            foreach (explode(',', $colValue) as $item) {
                $output .= $this->_params['multiOptions'][$item] . '<br/>';
            }
        } else {
            $output .= $this->_params['multiOptions']['***'] . '<br/>';
        }
        return $output;
    }
}
