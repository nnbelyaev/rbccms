<?php

namespace App\Datagrid\Filter;

use App\Datagrid\Datagrid;

class Basic
{
    protected $_datagridColumns = array();
    protected $_rawWheres = array();
    protected $_rawOrders = array();
    protected $_rawGroups = array();
    protected $_leftJoins = array();
    protected $_innerJoins = array();
    protected $_select;

    public function __construct(Datagrid $datagrid, array $elements, $options = null)
    {
        $this->_datagridColumns = $elements;
        $this->_select = $datagrid->getSelect();
    }

    public function addRawWhere($condition, array $values)
    {
        $this->_select->whereRaw($condition, $values);
        return;
    }

    public function addRawOrder($column, $direct) {
        $this->_select->orderBy($column, $direct);
        return;
    }

    public function addRawGroup($group) {
        $this->_select->groupBy($group);
    }

    public function addRawLeftJoin($table, $first, $operator = null, $second = null) {
        $this->_select->leftJoin($table, $first, $operator, $second);
    }

    public function addRawInnerJoin($table, $first, $operator = null, $second = null, $type = 'inner', $where = false) {
        $this->_select->join($table, $first, $operator, $second, $type, $where);
    }

    public function apply()
    {
        foreach ($this->_datagridColumns as $column => $params) {
            if ($params['filter'] && $params['value']) {
                $this->_select->where($column, '=', $params['value']);
            }
        }
        //echo $select;
        //exit;
    }
}