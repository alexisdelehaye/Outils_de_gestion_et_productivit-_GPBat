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

class DevisLogementPlomb implements InputFilterAwareInterface
{
    public $adressetravaux;
    public $nomchantier;
    public $reference;
    public $designation;
    public $emplacement;
    public $quantite;
    public $un;
    public $puht;
    public $totalht;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->adressetravaux    = !empty($data['adressetravaux']) ? $data['adressetravaux'] : null;
        $this->nomchantier= !empty($data['nomchantier']) ? $data['nomchantier'] : null;
        $this->reference = !empty($data['reference']) ? $data['reference'] : null;
        $this->designation = !empty($data['designation']) ? $data['designation'] : null;
        $this->emplacement = !empty($data['emplacement']) ? $data['emplacement'] : null;
        $this->quantite = !empty($data['quantite']) ? $data['quantite'] : null;
        $this->un  = !empty($data['un']) ? $data['un'] : null;
        $this->puht = !empty($data['puht']) ? $data['puht'] : null;
        $this->totalht = !empty($data['totalht']) ? $data['totalht'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'adressetravaux'     => $this->adressetravaux,
            'nomChantier' => $this->nomchantier,
            'reference' =>$this->reference ,
            'designation' => $this->designation,
            'emplacement' => $this->emplacement,
            'quantite'=> $this->quantite,
            'UN'  => $this->un,
            'puht' =>$this->puht,
            'totalht' =>$this->totalht
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
            'name' => 'adressetravaux',
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
            'name' => 'nomchantier',
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
            'name' => 'reference',
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
                        'max' => 15,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'designation',
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
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'emplacement',
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
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'un',
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
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'puht',
            'required' => false,
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
            'name' => 'quantite',
            'required' => false,
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
            'name' => 'totalht',
            'required' => false,
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