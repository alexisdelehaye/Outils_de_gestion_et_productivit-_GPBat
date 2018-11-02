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

class demarrageconfirmes implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $etatdemarrageconfirmes;
    public $observation;
    public $dateconfirmedemarrage;
    public $etatlogement;
    public $anneesdemarrageconfirmes;
    public $moisdemarrageconfirmes;
    public $nummoisdemarrageconfirmes;
    public $moisetanneesdemarrageconfirmes;
    public $semainedemarrageconfirmes;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->etatdemarrageconfirmes    = !empty($data['etatdemarrageconfirmes']) ? $data['etatdemarrageconfirmes'] : null;
        $this->observation= !empty($data['observation']) ? $data['observation'] : null;
        $this->dateconfirmedemarrage= !empty($data['dateconfirmedemarrage']) ? $data['dateconfirmedemarrage'] : null;
        $this->etatlogement= !empty($data['etatlogement']) ? $data['etatlogement'] : null;
        $this->anneesdemarrageconfirmes= !empty($data['anneesdemarrageconfirmes']) ? $data['anneesdemarrageconfirmes'] : null;
        $this->moisdemarrageconfirmes= !empty($data['moisdemarrageconfirmes']) ? $data['moisdemarrageconfirmes'] : null;
        $this->nummoisdemarrageconfirmes= !empty($data['nummoisdemarrageconfirmes']) ? $data['nummoisdemarrageconfirmes'] : null;
        $this->moisetanneesdemarrageconfirmes= !empty($data['moisetanneesdemarrageconfirmes']) ? $data['moisetanneesdemarrageconfirmes'] : null;
        $this->semainedemarrageconfirmes= !empty($data['semainedemarrageconfirmes']) ? $data['semainedemarrageconfirmes'] : null;
            }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'etatdemarrageconfirmes' => $this->etatdemarrageconfirmes,
            'observation' =>$this->observation,
            'dateconfirmedemarrage' =>$this->dateconfirmedemarrage,
            'etatlogement' =>$this->etatlogement,
            'anneesdemarrageconfirmes' =>$this->anneesdemarrageconfirmes,
            'moisdemarrageconfirmes' =>$this->moisdemarrageconfirmes,
            'nummoisdemarrageconfirmes' =>$this->nummoisdemarrageconfirmes,
            'moisetanneesdemarrageconfirmes' =>$this->moisetanneesdemarrageconfirmes,
            'semainedemarrageconfirmes' =>$this->semainedemarrageconfirmes,
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
            'name' => 'etatdemarrageconfirmes',
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
            'name' => 'dateconfirmedemarrage',
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
            'name' => 'etatlogement',
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
            'name' => 'anneesdemarrageconfirmes',
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
            'name' => 'moisdemarrageconfirmes',
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
            'name' => 'nummoisdemarrageconfirmes',
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
            'name' => 'moisetanneesdemarrageconfirmes',
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
            'name' => 'semainedemarrageconfirmes',
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