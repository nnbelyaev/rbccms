<?php

namespace App\Datagrid\Decorator;

class Date extends Basic
{
    protected $_format;

    public function __construct(array $params = array())
    {
        parent::__construct($params);
        $this->_format = 'd.m.Y';
    }

    public function render($colValue, array $options)
    {
        $timestamp = strtotime($colValue);
        return $timestamp ? strftime($this->_format, $timestamp) : '-';
    }
}
