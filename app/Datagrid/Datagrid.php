<?php

namespace App\Datagrid;

use App\Datagrid\Decorator\Checkbox;
use App\Datagrid\Decorator\Date;
use App\Datagrid\Decorator\Datetime;
use App\Datagrid\Decorator\MultiForeign;
use App\Datagrid\Decorator\Numformat;
use App\Datagrid\Decorator\SelectOption;
use Illuminate\Support\Facades\DB;

class Datagrid
{
    const DATATYPE_TEXT     = 'text';
    const DATATYPE_NUMERIC  = 'numeric';
    const DATATYPE_FINANCE  = 'finance';
    const DATATYPE_TEXTAREA = 'textarea';
    const DATATYPE_DATETIME = 'datetime';
    const DATATYPE_DATE     = 'date';
    const DATATYPE_BOOL     = 'bool';
    const DATATYPE_ENUM     = 'enum';
    const DATATYPE_SELECT   = 'select';

    const KEY_VALUES_SEPARATOR = '::';
    const MULTIROW_PARAM_NAME = 'multirow';
    protected $_allowMultiAction = true;
    protected $_autoFilterAllowed = true;
    protected $_columns = [];
    protected $_dgFilter;
    protected $_id;
    protected $_primary;
    protected $_info;
    protected $_rowDecorators = [];
    protected $_initColParams = array(
        'width'      => false,
        'label'      => false,
        'visible'    => true,
        'align'      => 'left',
        'sortable'   => true,
        'filterable' => true,
        'decorator'  => false,
        'sql_expr'   => false,
        'count_ave'  => false,
        'count_sum'  => false
    );
    protected $_itemValidCountPerPage = [20 => 20, 30 => 30, 50 => 50, 100 => 100, 200 => 200];
    protected $_itemPerPage = 20;
    protected $_currentPage = 1;
    protected $_needReformat = false;
    protected $_readOnly = false;
    protected $_rulesMetadata = [];
    protected $_ruleNameColumnNameDelimiter = '___';
    protected $_select;
    protected $_sortColumn;
    protected $_sortOrder;
    protected $_table;

    public function __construct($id, $table, array $columns = null, array $conditions = null)
    {
        $this->_table  = $table;
        $this->_select = DB::query();
        $this->_select->from($this->_table);
        $this->_columns   = $this->getTableInfo();
        $this->_id     = $id;

        if (!$columns) $columns = $this->_columns;
        $this->setColumns($columns);
        if (!in_array($this->_primary, $columns)) {
            try {
                $this->addColumn($this->_primary, ['visible' => false]);
            } catch (\Exception $e) {
            }
        }
        dd($this->_select);
    }

    public function getTableInfo() {
        $info = [];
        $fields = DB::select(\DB::raw('SHOW COLUMNS FROM '.$this->_table));
        foreach ($fields as $field) {
            $info[$field->Field] = ['type' => $this->inflectDatatype($field->Type)];
            if ($field->Key == 'PRI') $this->_primary = $field->Key;
        }
        return $info;
    }

    public function setColumns(array $columns)
    {
        foreach ($columns as $colId => $colParams) {
            $this->addColumn($colId, (array) $colParams);
        }
        return $this;
    }

    public function _isParentColumn($colId)
    {
        return false !== strpos($colId, $this->_ruleNameColumnNameDelimiter);
    }

    public function addColumn($colId, array $colParams = [])
    {
        if ($this->_isParentColumn($colId)) {
            /*
            list($rule, $colId) = explode($this->_ruleNameColumnNameDelimiter, $colId, 2);
            if (! array_key_exists($rule, $this->_info[Zend_Db_Table_Abstract::REFERENCE_MAP])) {
                throw new \Exception("Rule '{$rule}' is not exists in table reference map");
            }
            if (! array_key_exists($rule, $this->_rulesMetadata)) {
                $this->_rulesMetadata[$rule] = FT_Core::getAppModel($this->_info[Zend_Db_Table_Abstract::REFERENCE_MAP][$rule][Zend_Db_Table_Abstract::REF_TABLE_CLASS])->info(Zend_Db_Table_Abstract::METADATA);
            }
            $colMetadata = $this->_rulesMetadata[$rule];
            */
        }
        if (array_key_exists($colId, $this->_columns)) {
            $resultColParams = array_merge($this->_columns[$colId], $this->_initColParams, $colParams);
            if (false === $resultColParams['decorator']) {
                switch ($resultColParams['type']) {
                    case self::DATATYPE_BOOL:
                        $resultColParams['decorator'] = new Checkbox();
                        break;
                    case self::DATATYPE_DATE:
                        $resultColParams['decorator'] = new Date();
                        break;
                    case self::DATATYPE_DATETIME:
                        $resultColParams['decorator'] = new Datetime() ;
                        break;
                    case self::DATATYPE_NUMERIC:
                        $resultColParams['decorator'] = new Numformat();
                        break;
                    case self::DATATYPE_SELECT:
                        $multiOptions = isset($resultColParams['multiOptions']) && is_array($resultColParams['multiOptions']) ? $resultColParams['multiOptions'] : array();
                        $resultColParams['decorator'] = new SelectOption(array('multiOptions' => $multiOptions));
                        break;
                    case 'multiforeign':
                        $multiOptions = isset($resultColParams['multiOptions']) && is_array($resultColParams['multiOptions']) ? $resultColParams['multiOptions'] : array();
                        $resultColParams['decorator'] = new MultiForeign(array('multiOptions' => $multiOptions));
                        break;
                    default:
                        break;
                }
            }
            $this->_select->addSelect($colId);
        } elseif (! empty($colParams['sql_expr'])) {
            $resultColParams = array_merge($this->_initColParams, $colParams, array('filterable' => false));
            $this->_select->selectSub($colParams['sql_expr'], $colId);
        } else {
            throw new \Exception("Column '{$colId}' is not exists");
        }
        if (false === $resultColParams['label']) {
            $resultColParams['label'] = $colId;
        }
        $this->_columns[$colId] = $resultColParams;
        return;
    }

    public static function inflectDatatype($dbDataType)
    {
        list($dbDataTypeN) = preg_split('[\s|\(]', $dbDataType);

        switch ($dbDataTypeN) {
            case 'tinyint':
            case 'smallint':
            case 'mediumint':
            case 'int':
            case 'bigint':
            case 'float':
            case 'double':
                return self::DATATYPE_NUMERIC;
                break;
            case 'decimal':
                return self::DATATYPE_FINANCE;
                break;
            case 'date':
            case 'year':
                return self::DATATYPE_DATE;
                break;
            case 'datetime':
            case 'timestamp':
            case 'time':
                return self::DATATYPE_DATETIME;
                break;
            case 'tinytext':
            case 'mediumtext':
            case 'text':
                return self::DATATYPE_TEXTAREA;
                break;
            case 'binary(1)':
                return self::DATATYPE_BOOL;
                break;
            case 'varchar':
                return self::DATATYPE_TEXT;
                break;
            default:
                return self::DATATYPE_TEXT;
                break;
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getConditions()
    {
        return array(
            'page_number'   => $this->getCurrentPageNumber(),
            'sort_column'   => $this->getSortColumn(),
            'sort_order'    => $this->getSortOrder(),
            'rows_per_page' => $this->getItemCountPerPage(),
            'filter'        => $this->getDgFilter()->getValues(true)
        );
    }

    public function getSortColumn() {
        return $this->_sortColumn;
    }

    public function getSortOrder() {
        return $this->_sortOrder;
    }

    public function getItemCountPerPage() {
        return $this->_itemPerPage;
    }

    public function setItemCountPerPage($num) {
        $this->_itemPerPage = $num;
    }

    public function getCurrentPageNumber() {
        return $this->_currentPage;
    }

    public function setConditions($params)
    {
        if (! $params || ! is_array($params)) {
            return $this;
        }
        if (isset($params['page_number'])) {
            $this->_currentPage = $params['page_number'];
        }
        if (array_key_exists('sort_column', $params) && array_key_exists('sort_order', $params)) {
            if (isset($this->_columns[$params['sort_column']]) && $this->_columns[$params['sort_column']]['sortable']) {
                $this->_sortColumn = $params['sort_column'];
                $this->_sortOrder  = ('desc' == strtolower((string) $params['sort_order'])) ? 'desc' : 'asc';
            } else {
                $this->_sortColumn = null;
                $this->_sortOrder  = null;
            }
        }
        if (isset($params['filter']) && ($filter = $this->getDgFilter())) {
            $filter->populate($params['filter']);
        }
        if (isset($params['rows_per_page']) && array_key_exists($params['rows_per_page'], $this->_itemValidCountPerPage)) {
            $this->setItemCountPerPage($params['rows_per_page']);
        }
        return $this;
    }

    public function getDgFilter()
    {
        if (! $this->_dgFilter && $this->_autoFilterAllowed) {
            $this->setDgFilter(new FT_Datagrid_Filter_Auto($this));
        }
        return $this->_dgFilter;
    }

    public function setDgFilter($filter)
    {
        $this->_dgFilter = $filter;
        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function getSelect() {
        return $this->_select;
    }
}
