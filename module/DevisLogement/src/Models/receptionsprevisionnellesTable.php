<?php

namespace DevisLogement\Models;

use DateInterval;
use DateTime;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class receptionsprevisionnellesTable
{
    private $tableGateway;
    private $tabledemarrageconfirme;
    private $tabledemarrageprogramme;
    private $tableDemandelogement;
    private $tablejourinterruption;

    public function __construct(TableGatewayInterface $tableGateway,demarrageconfirmesTable $demarrageconfirmesTable,
                                demarrageprogrameTable $demarrageprogrameTable,demandelogementTable $demandelogementTable, joursinterruptionTable $joursinterruptionTable)
    {
        $this->tableGateway = $tableGateway;
        $this->tabledemarrageconfirme = $demarrageconfirmesTable;
        $this->tabledemarrageprogramme = $demarrageprogrameTable;
        $this->tableDemandelogement = $demandelogementTable;
        $this->tablejourinterruption = $joursinterruptionTable;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getreceptionsprevisionnelles($id)
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

    public function savereceptionsprevisionnelles(receptionprevisionnelles $receptionsprevisionnelles, $id)
    {
        $MoisAnnee = ['JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE'];

        $demarrageconfirmeconcerne = $this->tabledemarrageconfirme->getDemarrageConfirme($id);
        $demarrageprogrammeconcerne = $this->tabledemarrageprogramme->getdemarrageprogramme($id);
        $demandelogementconcerne = $this->tableDemandelogement->getDemandeLogement($id);
        $jourinterruptionconcerne = $this->tablejourinterruption->getjoursinterruption($id);

        if ($demarrageconfirmeconcerne->dateconfirmedemarrage == null and $demarrageprogrammeconcerne->datedemarrageprogramme == null){
            $receptionsprevisionnelles->datereceptionprevisionnelle = null;
        }

        if ($demarrageconfirmeconcerne->dateconfirmedemarrage != null and $demarrageprogrammeconcerne->datedemarrageprogramme != null){
            if ($demarrageconfirmeconcerne->etatdemarrageconfirmes != 'CONFIRME' and $demandelogementconcerne->delaimarcheensemaine== null ){
                $receptionsprevisionnelles->datereceptionprevisionnelle = null;
            }
            if ($demarrageconfirmeconcerne->etatdemarrageconfirmes != 'CONFIRME' and $demandelogementconcerne->delaimarcheensemaine!= null ){
                $delaiSup = ((intval($demandelogementconcerne->delaimarcheensemaine) * 7))+$jourinterruptionconcerne->nbtotaljourinterruption;
                $Date =new DateTime((string)  $demarrageprogrammeconcerne->datedemarrageprogramme);
                $Date->add(new DateInterval('P'.$delaiSup.'D'));
                $receptionsprevisionnelles->datereceptionprevisionnelle= $Date->format('Y-m-d');
            }

            if ($demarrageconfirmeconcerne->etatdemarrageconfirmes == 'CONFIRME' and $demandelogementconcerne->delaimarcheensemaine!= null ){
                $delaiSup = ((intval($demandelogementconcerne->delaimarcheensemaine) * 7))+$jourinterruptionconcerne->nbtotaljourinterruption;
                $Date =new DateTime((string)  $demarrageconfirmeconcerne->dateconfirmedemarrage);
                $Date->add(new DateInterval('P'.$delaiSup.'D'));
                $receptionsprevisionnelles->datereceptionprevisionnelle= $Date->format('Y-m-d');
            }

            if ($demarrageconfirmeconcerne->etatdemarrageconfirmes == 'CONFIRME' and $demandelogementconcerne->delaimarcheensemaine== null ){
                $receptionsprevisionnelles->datereceptionprevisionnelle= "CONFIRMER DELAI";
            }
        }


        if ($receptionsprevisionnelles->datereceptionprevisionnelle == null) {
            $receptionsprevisionnelles->anneesreceptionprevisionnelle ="01-STOCK";
            $receptionsprevisionnelles->moisreceptionprevisionnelle = "01-STOCK";
            $receptionsprevisionnelles->nummoisrecepetionprevisionnelle = "01-STOCK";
            $receptionsprevisionnelles->moisetanneesreceptionprevisionnelle = "01-STOCK";
            $receptionsprevisionnelles->semainereceptionprevisionnelle = "S-00";
        }

        if ($receptionsprevisionnelles->datereceptionprevisionnelle != null){


            $Date = new DateTime((string)$receptionsprevisionnelles->datereceptionprevisionnelle);
            $year = $Date->format('Y');

            $MonthValue = $Date->format('m');
            $week = $Date->format('W');


            $receptionsprevisionnelles->anneesreceptionprevisionnelle =$year;
            $receptionsprevisionnelles->moisreceptionprevisionnelle = $MoisAnnee[$MonthValue - 1];
            $receptionsprevisionnelles->nummoisrecepetionprevisionnelle = $MonthValue;
            $receptionsprevisionnelles->moisetanneesreceptionprevisionnelle = $year.'-'.$MonthValue.'-'.$MoisAnnee[$MonthValue - 1] ;
            $receptionsprevisionnelles->semainereceptionprevisionnelle = "S-".$week;
        }


        $data = [
            'idlogementconcerne' => (int)$id,
            'datereceptionprevisionnelle' => $receptionsprevisionnelles->datereceptionprevisionnelle,
            'anneesreceptionprevisionnelle' => $receptionsprevisionnelles->anneesreceptionprevisionnelle,
            'moisreceptionprevisionnelle' => $receptionsprevisionnelles->moisreceptionprevisionnelle,
            'nummoisrecepetionprevisionnelle' => $receptionsprevisionnelles->nummoisreceptionprevisionnelle,
            'moisetanneesreceptionprevisionnelle' => $receptionsprevisionnelles->moisetanneesreceptionprevisionnelle,
            'semainereceptionprevisionnelle' => $receptionsprevisionnelles->semainereceptionprevisionnelle,
        ];

        $this->tableGateway->insert($data);

    }

    public function deletePoste($id)
    {
        $this->tableGateway->delete(['idlogementconcerne' => (int)$id]);
    }
}