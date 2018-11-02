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

class oprprevisionnelle implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $datesprevisionnelleopr;
    public $anneesoprprevisionnelle;
    public $nummoisoprprevisionnelle;
    public $moisetanneesoprprevisionnelle;
    public $semaineoprprevisionnelle;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->datesprevisionnelleopr    = !empty($data['datesprevisionnelleopr']) ? $data['datesprevisionnelleopr'] : null;
        $this->anneesoprprevisionnelle= !empty($data['anneesoprprevisionnelle']) ? $data['anneesoprprevisionnelle'] : null;
        $this->nummoisoprprevisionnelle= !empty($data['nummoisoprprevisionnelle']) ? $data['nummoisoprprevisionnelle'] : null;
        $this->moisetanneesoprprevisionnelle= !empty($data['moisetanneesoprprevisionnelle']) ? $data['moisetanneesoprprevisionnelle'] : null;
        $this->semaineoprprevisionnelle= !empty($data['semaineoprprevisionnelle']) ? $data['semaineoprprevisionnelle'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'datesprevisionnelleopr' => $this->datesprevisionnelleopr,
            'anneesoprprevisionnelle' =>$this->anneesoprprevisionnelle,
            'nummoisoprprevisionnelle' =>$this->nummoisoprprevisionnelle,
            'moisetanneesoprprevisionnelle' =>$this->moisetanneesoprprevisionnelle,
            'semaineoprprevisionnelle' =>$this->semaineoprprevisionnelle,
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
            'name' => 'idlogementconcerne',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'datesprevisionnelleopr',
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
            'name' => 'anneesoprprevisionnelle',
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
            'name' => 'nummoisoprprevisionnelle',
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
            'name' => 'moisetanneesoprprevisionnelle',
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
            'name' => 'semaineoprprevisionnelle',
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


        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }


}