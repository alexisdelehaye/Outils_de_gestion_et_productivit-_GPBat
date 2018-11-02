<?php
/**
 * Created by PhpStorm.
 * User: cdcde
 * Date: 18/04/2018
 * Time: 22:34
 */

namespace DevisLogement\Controller;

use DevisLogement\Form\LogementForm;
use DevisLogement\Form\PafiForm;
use DevisLogement\Form\RechercheIdMasterDispatchingForm;
use DevisLogement\Models\devtceTable;
use DevisLogement\Models\Logement;
use DevisLogement\Models\LogementTable;
use DevisLogement\Models\masterdispatchingTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DevisLogement\Form\CalculNbUniteRefForm;

class LogementController extends AbstractActionController
{

    private $tableLogements;
    private $tableDevisTCE;
    public $tableMasterDispatching;


    public function __construct(LogementTable $table, devtceTable $devtceTable, masterdispatchingTable $masterdispatchingTable)
    {
        $this->tableLogements = $table;
        $this->tableDevisTCE = $devtceTable;
        $this->tableMasterDispatching = $masterdispatchingTable;
    }

    public function indexAction()
    {
        return new ViewModel([
            'logements' => $this->tableLogements->fetchAll()
        ]);

    }

    public function AffichageMasterDispatchingAction()
    {
        $listeNomLot = array();
        $Dispatch = $this->tableMasterDispatching->fetchAll();
        $listecode = array();
        $dataTable = array();
        $Alphabet = ['A','Z','E','R','T','Y','U','I','O','P','Q','S','D','F','G','H','J','k','L','M','W','X','C','V','B','N'];

        foreach ($Dispatch as $d) {
            $lettre = $d->nomlot;
            if (!in_array($d->nomlot, $listeNomLot) and !in_array($lettre[0],$Alphabet)) {
                array_push($listeNomLot, $d->nomlot);
            }
        }

        foreach ($Dispatch as $d) {
            if (!in_array($d->codemetc, $listecode)) {
                array_push($listecode, $d->codemetc);
            }
        }
        foreach ($listeNomLot as $lot) {
            foreach ($listecode as $d) {
                $Data = $this->tableMasterDispatching->getElementMasterDispatching($d, $lot);
                if ($Data != null) {
                    array_push($dataTable, $Data);
                }
            }
        }

        return new ViewModel([
            'MasterDispatching' => $dataTable,
            'listeNomLot' => $listeNomLot,
        ]);
    }


    public function UploadDevisAction()
    {
        $view = new ViewModel();
        $view->setTemplate('devis-logement/logement/UploadDevisTCE');
        return $view;
    }

    public function ComparaisonPrixAction()
    {

        $view = new ViewModel();
        $view->setVariable('TableDispatch', $this->tableMasterDispatching->fetchAll());
        $view->setTemplate('devis-logement/logement/Master_Disptaching/ComparaisonPrix');
        return $view;
    }


    public function addLogementBaseAction()
    {
        $form = new LogementForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $Logement = new Logement();
        $form->setInputFilter($Logement->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }
        $cite = $form->get('cite')->getValue();
        $pilotegpbat = $form->get('pilotegpbat')->getValue();
        $Logement->exchangeArray($form->getData());
        $this->tableLogements->saveLogement($Logement, $cite, $pilotegpbat);

        return $this->redirect()->toRoute('logements');
    }


    public function addPafiAction()
    {

        $form = new PafiForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $Logement = new Logement();
        $form->setInputFilter($Logement->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $Logement->exchangeArray($form->getData());
        $this->tableLogements->saveLogement($Logement);
        $view = new ViewModel();
        $view->setTemplate('devis-logement/logement/addLogementBase');
        return $view;


    }


    public function detailsAction()
    {

        return new ViewModel([
            'details' => $this->tableDevisTCE->fetchAll(),
        ]);

    }


    public function CalculNombreReferenceAction()
    {


        $form = new CalculNbUniteRefForm();
        $form->get('submit')->setValue('rechercher');

        $request = $this->getRequest();
        $form->setData($request->getPost());

        if (!$request->isPost()) {
            return ['form' => $form];
        }


        $Ref = (string)$form->get('search')->getValue();


        $view = new ViewModel();
        $view->setVariable('NombreRéférence', $Ref);
        $view->setTemplate('devis-logement/resultatRequete/ResultatCalcNbRef');
        return $view;


    }

    public function ConversionbdVersExcelAction()
    {

        $listeNomLot = array();
        $Dispatch = $this->tableMasterDispatching->fetchAll();
        $listecode = array();
        $dataTable = array();
        $Alphabet = ['A','Z','E','R','T','Y','U','I','O','P','Q','S','D','F','G','H','J','k','L','M','W','X','C','V','B','N'];

        foreach ($Dispatch as $d) {
            $lettre = $d->nomlot;
            if (!in_array($d->nomlot, $listeNomLot) and !in_array($lettre[0],$Alphabet)) {
                array_push($listeNomLot, $d->nomlot);
            }
        }

        foreach ($Dispatch as $d) {
            if (!in_array($d->codemetc, $listecode)) {
                array_push($listecode, $d->codemetc);
            }
        }
        foreach ($listeNomLot as $lot) {
            foreach ($listecode as $d) {
                $Data = $this->tableMasterDispatching->getElementMasterDispatching($d, $lot);
                if ($Data != null ) {
                    array_push($dataTable, $Data);
                }
            }
        }

        $view = new ViewModel();
        $view->setVariable('listeNomLot', $listeNomLot);
        $view->setVariable('dataTable', $dataTable);
        $view->setTemplate('devis-logement/logement/Master_Disptaching/ExportDataMasterDispatchingToExcel/ExportPage');
        return $view;


    }


    public function RechercheIdMasterDispatchingAction()
    {

        $form = new RechercheIdMasterDispatchingForm();
        $form->get('submit')->setValue('rechercher');

        $request = $this->getRequest();
        $form->setData($request->getPost());

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $Ref = $form->get('search')->getValue();
        $ElementConcerne = $this->tableMasterDispatching->getElementMasterDispatchingparid($Ref);

        $view = new ViewModel();
        $view->setVariable('NombreRéférence', $Ref);
        $view->setVariable('ElementConcerne', $ElementConcerne);
        $view->setTemplate('devis-logement/logement/Master_Disptaching/ResultatRequeteMasterDispatching/ResultatRequete');
        return $view;


    }

    public function SumPrixUnParRefAction()
    {

        $form = new CalculNbUniteRefForm();
        $form->get('submit')->setValue('rechercher');

        $request = $this->getRequest();
        $form->setData($request->getPost());

        if (!$request->isPost()) {
            return ['form' => $form];
        }


        $Ref = (string)$form->get('search')->getValue();


        $view = new ViewModel();
        $view->setVariable('Reference', $Ref);
        $view->setTemplate('devis-logement/resultatRequete/ResultatSumPrixUnParRef');
        return $view;


    }

    public function uploadMasterDispatchingAction()
    {

        $view = new ViewModel();
        $view->setTemplate('devis-logement/logement/Master_Disptaching/uploadDistaching');
        return $view;
    }


    public function UploadBORDEREAUMAISONSCITESAction(){

        $view = new ViewModel();
        $view->setTemplate('devis-logement/Amiante_Et_Plomb/Upload_Devis_Amiante_Plomb');
        return $view;
    }


    public function AffichageListeLogementCreerAction()
    {
        $listeLogement = $this->tableLogements->fetchAll();
        $view = new ViewModel();
        $view->setVariable('Reference', $listeLogement);
        $view->setTemplate('/devis-logement/logement/ProgrammationLogement/ListeLogementCreer');
        return $view;

    }


}
