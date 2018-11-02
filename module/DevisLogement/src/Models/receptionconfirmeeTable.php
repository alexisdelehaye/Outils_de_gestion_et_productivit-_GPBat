<?php

namespace DevisLogement\Models;

use DateInterval;
use DateTime;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class receptionrecadreeTable
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

    public function getreceptionrecadree($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(['idlogementconcerne' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function savereceptionrecadree(oprrecadrees $oprrecadrees,$id)
    {
        $receptionrecadree = new receptionrecadree();

        $MoisAnnee = ['JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE'];

        if ($oprrecadrees->datesoprrecadree != null){

            $Date =new DateTime((string)  $oprrecadrees->datesoprrecadree);
            $Date->add(new DateInterval('P7D'));
            $receptionrecadree->datesreceptionrecadree= $Date->format('Y-m-d');
        }


        if ($receptionrecadree->datesreceptionrecadree != null){


            $Date = new DateTime((string)$receptionrecadree->datesreceptionrecadree);
            $year = $Date->format('Y');

            $MonthValue = $Date->format('m');
            $week = $Date->format('W');


            $receptionrecadree->anneesreceptionrecadree =$year;
            $receptionrecadree->moisreceptionrecadree = $MoisAnnee[$MonthValue - 1];
            $receptionrecadree->nummoisreceptionrecadree = $MonthValue;
            $receptionrecadree->moisetanneesreceptionrecadree = $year.'-'.$MonthValue.'-'.$MoisAnnee[$MonthValue - 1] ;
            $receptionrecadree->semainereceptionrecadree = "S-".$week;
        }


        if ($oprrecadrees->datesoprrecadree == null){
            $receptionrecadree->datesreceptionrecadree = null;
        }


        if ($receptionrecadree->datesreceptionrecadree == null) {
            $receptionrecadree->anneesreceptionrecadree ="01-STOCK";
            $receptionrecadree->moisreceptionrecadree = "01-STOCK";
            $receptionrecadree->nummoisreceptionrecadree = "01-STOCK";
            $receptionrecadree->moisetanneesreceptionrecadree = "01-STOCK";
            $receptionrecadree->semainereceptionrecadree = "S-00";
        }


        $data = [
            'idlogementconcerne' => (int)$id,
            'datesreceptionrecadree' => $receptionrecadree->datesreceptionrecadree,
            'anneesreceptionrecadree' =>$receptionrecadree->anneesreceptionrecadree,
            'moisreceptionrecadree' => $receptionrecadree->moisreceptionrecadree,
            'nummoisreceptionrecadree' => $receptionrecadree->nummoisreceptionrecadree,
            'moisetanneesreceptionrecadree' => $receptionrecadree->moisetanneesreceptionrecadree,
            'semainereceptionrecadree' => $receptionrecadree->semainereceptionrecadree,
        ];

        $this->tableGateway->insert($data);

    }


}