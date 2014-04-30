<?php

namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class DbModel
{

    protected $tableGateway;
    protected $tableName;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->tableName    = $this->tableGateway->table;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function grid($params)
    {
        $grid = array();

        $order    = (isset($params['order'])) ? $params['order'] : 'DESC';
        $sort     = (isset($params['sort'])) ? $params['sort'] : 'id';
        $per_page = (isset($params['per_page'])) ? $params['per_page'] : 10;
        $page     = (isset($params['page'])) ? $params['page'] : 1;
        $filters  = (isset($params['filter'])) ? $params['filter'] : array();
        $count    = $this->getCount($filters);

        $select      = new Select($this->tableName);
        $filterQuery = '';
        foreach ($filters as $key => $value)
        {
            if (!empty($value))
            {
                $select->where("$key LIKE '%$value%'");
                $filterQuery .= "&filter[$key]=$value";
            }
        }

        $select->limit($per_page);
        $offset = $per_page * ($page - 1);
        $select->order("$sort $order");
        $select->offset($offset);
        //echo $select->getSqlString(); exit;
        $rows = $this->tableGateway->selectWith($select);

        foreach ($rows as $row)
        {
            $grid['data'][] = $row;
        }

        $grid['order']       = $order;
        $grid['sort']        = $sort;
        $grid['per_page']    = $per_page;
        $grid['page']        = $page;
        $grid['count']       = $count;
        $grid['filters']     = $filters;
        $grid['filterQuery'] = $filterQuery;
        $grid['pages']       = ceil($count / $per_page);

        return $grid;
    }

    public function getCount($filters = NULL)
    {
        $select = new Select($this->tableName);
        $select->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(id)')));
        foreach ($filters as $key => $value)
        {
            if (!empty($value))
            {
                $select->where("$key LIKE '%$value%'");
            }
        }
        //echo $select->getSqlString(); exit;
        $stmt = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $row  = $stmt->execute()->current();
        return $row['count'];
    }

    public function save($data)
    {
        $data['created_date'] = date("Y-m-d H:i:s");
        return $this->tableGateway->insert($data);
    }

}
