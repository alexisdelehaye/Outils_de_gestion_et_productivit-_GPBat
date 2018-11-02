<?php

namespace DevisLogement\Models;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class joursinterruptionTable
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

    public function getjoursinterruption($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['idlogementconcerne' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function savejoursinterruption(joursinterruption $joursinterruption,$id)
    {
        $data = [

            'idlogementconcerne' => (int) $id,
            'nbjoursferies'  =>  $joursinterruption->nbjoursferies,
            'nbjourscp' =>  $joursinterruption->nbjourscp,
            'nbjoursintempérie' => $joursinterruption->nbjoursintempérie,
            'nbjoursamiante'=> $joursinterruption->nbjoursamiante,
            'nbjoursinterruptionplomb'=> $joursinterruption->nbjoursinterruptionplomb,
            'nbtotaljourinterruption'=> $joursinterruption->nbtotaljourinterruption,


        ];


        $id = (int) $logement->idlogement;
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getLogement($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['idlogement' => $id]);


        $this->tableGateway->insert($data);
    }

    /*

    public function deletePoste($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }

    */
}