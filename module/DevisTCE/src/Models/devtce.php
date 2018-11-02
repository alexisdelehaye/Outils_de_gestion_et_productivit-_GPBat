<?php

namespace ExportDevisTCEFromExcel\Models;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class devtce implements InputFilterAwareInterface
{
    public $idcode;
    public $désignationcode;
    public $localisation;
    public $un;
    public $quantité;
    public $pu;
    public $prix_total;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idcode    = !empty($data['idcode']) ? $data['idcode'] : null;
        $this->désignationcode= !empty($data['désignationcode']) ? $data['désignationcode'] : null;
        $this->localisation = !empty($data['localisation']) ? $data['localisation'] : null;
        $this->un = !empty($data['un']) ? $data['un'] : null;
        $this->quantité = !empty($data['quantité']) ? $data['quantité'] : null;
        $this->pu  = !empty($data['pu']) ? $data['pu'] : null;
        $this->prix_total = !empty($data['prix_total']) ? $data['prix_total'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idcode'     => $this->idcode,
            'désignationcode' => $this->désignationcode,
            'localisation' =>$this->localisation ,
            'quantité' => $this->quantité,
            'un' => $this->un,
            'pu'  => $this->pu,
            'prix_total' =>$this->prix_total,
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
            'name' => 'idcode',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'désignationcode',
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
            'name' => 'localisation',
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
                        'max' => 5,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'quantité',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'pu',
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
            'name' => 'prix_total',
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