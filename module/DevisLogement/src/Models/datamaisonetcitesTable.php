<?php

namespace DevisLogement\Models;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class datamaisonetcitesTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }


}
