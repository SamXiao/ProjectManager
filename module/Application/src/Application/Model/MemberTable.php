<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class MemberTable
{

    public $tableGateway = null;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
                    return $resultSet;
    }


}

