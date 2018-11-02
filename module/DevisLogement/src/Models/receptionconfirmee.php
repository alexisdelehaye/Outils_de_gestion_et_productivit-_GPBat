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

class receptionconfirmee implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $datesreceptionrecadree;
    public $anneesreceptionrecadree;
    public $moisreceptionrecadree;
    public $nummoisreceptionrecadree;
    public $moisetanneesreceptionrecadree;
    public $semainereceptionrecadree;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->datesreceptionrecadree= !empty($data['datesreceptionrecadree']) ? $data['datesreceptionrecadree'] : null;
        $this->anneesreceptionrecadree = !empty($data['anneesreceptionrecadree']) ? $data['anneesreceptionrecadree'] : null;
        $this->moisreceptionrecadree = !empty($data['moisreceptionrecadree']) ? $data['moisreceptionrecadree'] : null;
        $this->nummoisreceptionrecadree = !empty($data['nummoisreceptionrecadree']) ? $data['nummoisreceptionrecadree'] : null;
        $this->moisetanneesreceptionrecadree = !empty($data['moisetanneesreceptionrecadree']) ? $data['moisetanneesreceptionrecadree'] : null;
        $this->semainereceptionrecadree  = !empty($data['semainereceptionrecadree']) ? $data['semainereceptionrecadree'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'datesreceptionrecadree' => $this->datesreceptionrecadree,
            'anneesreceptionrecadree' =>$this->anneesreceptionrecadree ,
            'moisreceptionrecadree' => $this->moisreceptionrecadree,
            'nummoisreceptionrecadree' => $this->nummoisreceptionrecadree,
            'moisetanneesreceptionrecadree'=> $this->moisetanneesreceptionrecadree,
            'semainereceptionrecadree'  => $this->semainereceptionrecadree,
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
            'name' => 'datesreceptionrecadree',
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
            'name' => 'anneesreceptionrecadree',
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
            'name' => 'moisreceptionrecadree',
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
            'name' => 'nummoisreceptionrecadree',
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
            'name' => 'moisetanneesreceptionrecadree',
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
            'name' => 'semainereceptionrecadree',
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