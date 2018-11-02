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

class commandesreçues implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $datecommanderecue;
    public $etatcommanderecue;
    public $anneescommanderecue;
    public $moiscommanderecue;
    public $nummoiscommanderecue;
    public $moisetanneescommanderecue;
    public $semainecommanderecue;

    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->datecommanderecue    = !empty($data['datecommanderecue']) ? $data['datecommanderecue'] : null;
        $this->etatcommanderecue= !empty($data['etatcommanderecue']) ? $data['etatcommanderecue'] : null;
        $this->anneescommanderecue= !empty($data['anneescommanderecue']) ? $data['anneescommanderecue'] : null;
        $this->moiscommanderecue= !empty($data['moiscommanderecue']) ? $data['moiscommanderecue'] : null;
        $this->nummoiscommanderecue= !empty($data['nummoiscommanderecue']) ? $data['nummoiscommanderecue'] : null;
        $this->moisetanneescommanderecue= !empty($data['moisetanneescommanderecue']) ? $data['moisetanneescommanderecue'] : null;
        $this->semainecommanderecue= !empty($data['semainecommanderecue']) ? $data['semainecommanderecue'] : null;

    }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'datecommanderecue' => $this->datecommanderecue,
            'etatcommanderecue' =>$this->etatcommanderecue,
            'anneescommanderecue' =>$this->anneescommanderecue,
            'moiscommanderecue' =>$this->moiscommanderecue,
            'nummoiscommanderecue' =>$this->nummoiscommanderecue,
            'moisetanneescommanderecue' =>$this->moisetanneescommanderecue,
            'semainecommanderecue' =>$this->semainecommanderecue,
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
            'name' => 'datecommanderecue',
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
            'name' => 'etatcommanderecue',
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
            'name' => 'anneescommanderecue',
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
            'name' => 'moiscommanderecue',
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
            'name' => 'nummoiscommanderecue',
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
            'name' => 'moisetanneescommanderecue',
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
                    'name' => 'semainecommanderecue',
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