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

class demarrageprogramme implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $etatdemarrageprogramme;
    public $observation;
    public $datedemarrageprogramme;
    public $anneesdemarrageprogramme;
    public $moisdemarrageprogramme;
    public $nummoisdemarrageprogramme;
    public $moisetanneesdemarrageprogramme;
    public $semainedemarrageprogramme;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->etatdemarrageprogramme    = !empty($data['etatdemarrageprogramme']) ? $data['etatdemarrageprogramme'] : null;
        $this->observation= !empty($data['observation']) ? $data['observation'] : null;
        $this->datedemarrageprogramme= !empty($data['datedemarrageprogramme']) ? $data['datedemarrageprogramme'] : null;
        $this->anneesdemarrageprogramme= !empty($data['anneesdemarrageprogramme']) ? $data['anneesdemarrageprogramme'] : null;
        $this->moisdemarrageprogramme= !empty($data['moisdemarrageprogramme']) ? $data['moisdemarrageprogramme'] : null;
        $this->nummoisdemarrageprogramme= !empty($data['nummoisdemarrageprogramme']) ? $data['nummoisdemarrageprogramme'] : null;
        $this->moisetanneesdemarrageprogramme= !empty($data['moisetanneesdemarrageprogramme']) ? $data['moisetanneesdemarrageprogramme'] : null;
        $this->semainedemarrageprogramme= !empty($data['semainedemarrageprogramme']) ? $data['semainedemarrageprogramme'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'etatdemarrageprogramme' => $this->etatdemarrageprogramme,
            'observation' =>$this->observation,
            'datedemarrageprogramme' =>$this->datedemarrageprogramme,
            'anneesdemarrageprogramme' =>$this->anneesdemarrageprogramme,
            'moisdemarrageprogramme' =>$this->moisdemarrageprogramme,
            'nummoisdemarrageprogramme' =>$this->nummoisdemarrageprogramme,
            'moisetanneesdemarrageprogramme' =>$this->moisetanneesdemarrageprogramme,
            'semainedemarrageprogramme' =>$this->semainedemarrageprogramme,
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
            'name' => 'etatdemarrageprogramme',
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
            'name' => 'observation',
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
            'name' => 'datedemarrageprogramme',
            'required' => false,
        ]);


        $inputFilter->add([
            'name' => 'anneesdemarrageprogramme',
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
            'name' => 'moisdemarrageprogramme',
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
            'name' => 'nummoisdemarrageprogramme',
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
        'name' => 'moisetanneesdemarrageprogramme',
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
            'name' => 'semainedemarrageprogramme',
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