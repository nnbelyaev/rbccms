<?php

namespace App\Datagrid\Decorator;

class Checkbox extends Basic
{
    public function render($colValue, array $options)
    {
        return '<input type="checkbox"' . ($colValue ? ' checked="checked"' : '') . ' disabled="disabled" class="ch_box" />';
    }
}
