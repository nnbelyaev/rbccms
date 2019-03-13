<?php

namespace App\Datagrid\Decorator;

class SelectOption extends Basic
{
    public function render($colValue, array $options)
    {
        return isset($this->_params['multiOptions'][$colValue]) ? htmlspecialchars($this->_params['multiOptions'][$colValue]) : 'not defined';
    }
}
