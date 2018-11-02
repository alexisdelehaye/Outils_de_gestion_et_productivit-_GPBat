<?php

namespace DevisLogement\Models;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class commandesrecuesTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function saveCommanderecue(commandesrecues $commandesrecues, $id)
    {

        $data = [
            'idlogementconcerne' => (int)$id,
            'datecommanderecue ' => $commandesrecues->datecommanderecue ,
            'etatcommanderecue'  => $commandesrecues->etatcommanderecue,
            'anneescommanderecue'  => $commandesrecues->anneescommanderecue,
            'moiscommanderecue'  => $commandesrecues->moiscommanderecue,
            'nummoiscommanderecue'  => $commandesrecues->nummoiscommanderecue,
            'moisetanneescommanderecue'  => $commandesrecues->moisetanneescommanderecue,
            'semainecommanderecue'  => $commandesrecues->semainecommanderecue,
        ];

        $this->tableGateway->insert($data);
        return;
    }





}