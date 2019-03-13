<?php

namespace App\Datagrid\Filter;

use App\Datagrid\Datagrid;

class Auto extends Basic
{
    public function __construct(Datagrid $datagrid, $options = null)
    {
        $filterElements = array();
        foreach ($datagrid->getColumns() as $columnId => $columnParams) {
            if($columnParams['filterable']) {
                $elementOptions = array();
                switch ($columnParams['type']) {
                    case Datagrid::DATATYPE_DATETIME:
                    case Datagrid::DATATYPE_DATE:
                        $elementType = 'dateFromto';
                        break;
                    case Datagrid::DATATYPE_BOOL:
                        $elementType = 'select';
                        $elementOptions['multiOptions'] = [
                            '***' => 'not selected',
                            0 => 'no',
                            1 => 'yes'
                        ];
                        break;
                    case Datagrid::DATATYPE_SELECT:
                        if (isset($columnParams['multiOptions']) && is_array($columnParams['multiOptions'])) {
                            $elementOptions['multiOptions'] = $columnParams['multiOptions'];
                        }
                        $elementType = 'select';
                        break;
                    case 'multiforeign':
                        if (isset($columnParams['multiOptions']) && is_array($columnParams['multiOptions'])) {
                            $elementOptions['multiOptions'] = $columnParams['multiOptions'];
                        }
                        $elementType = 'select';
                        break;
                    default:
                        $elementType = 'text';
                        $elementOptions['class'] = 'ft_element';
                        break;
                }
                $filterElements[] = array($elementType, $columnId, $elementOptions);
            }
        }
        parent::__construct($datagrid, $filterElements, $options);
    }
}