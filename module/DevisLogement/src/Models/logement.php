<?php

namespace DevisLogement\Models;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class DevisLogement implements InputFilterAwareInterface
{
    public $idLogement;
    public $idRéférenceLogement;
    public $Ville;
    public $Cité;
    public $NuméroRue;
    public $Rue;
    public $adresse;
    public $EtatLogement;
    public $EtatDemande;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idLogement    = !empty($data['idLogement']) ? $data['idLogement'] : null;
        $this->idRéférenceLogement= !empty($data['idRéférenceLogement']) ? $data['idRéférenceLogement'] : null;
        $this->Ville = !empty($data['Ville']) ? $data['Ville'] : null;
        $this->Cité = !empty($data['Cité']) ? $data['Cité'] : null;
        $this->NuméroRue  = !empty($data['NuméroRue']) ? $data['NuméroRue'] : null;
        $this->Rue = !empty($data['Rue']) ? $data['Rue'] : null;
        $this->adresse = !empty($data['adresse']) ? $data['adresse'] : null;
        $this->EtatLogement = !empty($data['EtatLogement']) ? $data['EtatLogement'] : null;
        $this->EtatDemande = !empty($data['EtatDemande']) ? $data['EtatDemande'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idLogement'     => $this->idLogement,
            'idRéférenceLogement' => $this->idRéférenceLogement,
            'Ville ' =>$this->Ville ,
            'Cité' => $this->Cité,
            'NuméroRue'  => $this->NuméroRue,
            'Rue' =>$this->Rue,
            'adresse' =>$this->adresse,
            'EtatLogement' =>$this->EtatLogement,
            'EtatDemande' =>$this->EtatDemande,
        ];
    }


    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'idCode',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'DésignationCode',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Localisation',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,

                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'UN',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 5,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Quantité',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'PU',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Float',
                    'options' => array(
                        'min' => 0,
                    ),
                ),
            ),
        ]);

        $inputFilter->add([
            'name' => 'Prix_Total',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Float',
                    'options' => array(
                        'min' => 0,
                    ),
                ),
            ),
        ]);
        
        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }


}