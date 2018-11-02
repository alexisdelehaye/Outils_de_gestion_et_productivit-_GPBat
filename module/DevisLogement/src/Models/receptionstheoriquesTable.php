<?php

namespace DevisLogement\Models;

use DateTime;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class receptionstheoriquesTable
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

    public function getreceptionstheoriques($id)
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

    public function savereceptionstheoriques(receptionstheoriques $receptionstheoriques, $id)
    {
        $MoisAnnee = ['JANVIER','FEVRIER','MARS','AVRIL','MAI','JUIN','JUILLET','AOUT','SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE'];

        $data = [
            'idlogementconcerne'=> (int)$id,
            'datereceptiontheorique' => $receptionstheoriques->datereceptiontheorique,
            'anneesreceptiontheorique'  => $receptionstheoriques->anneesreceptiontheorique,
            'moisreceptiontheorique' => $receptionstheoriques->moisreceptiontheorique,
            'nummoisrecepetiontheorique' => $receptionstheoriques->nummoisrecepetiontheorique,
            'moisetanneesreceptiontheorique' => $receptionstheoriques->moisetanneesreceptiontheorique,
            'semainereceptiontheorique'=> $receptionstheoriques->semainereceptiontheorique,
        ];

        $this->tableGateway->insert($data);

    }

    public function deletePoste($id)
    {
        $this->tableGateway->delete(['idlogementconcerne' => (int) $id]);
    }
}