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

class receptionprevisionnelles implements InputFilterAwareInterface
{
    public $idlogementconcerne;
    public $datereceptionprevisionnelle;
    public $anneesreceptionprevisionnelle;
    public $moisreceptionprevisionnelle;
    public $nummoisreceptionprevisionnelle;
    public $moisetanneesreceptionprevisionnelle;
    public $semainereceptionprevisionnelle;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->datereceptionprevisionnelle= !empty($data['datereceptionprevisionnelle']) ? $data['datereceptionprevisionnelle'] : null;
        $this->anneesreceptionprevisionnelle = !empty($data['anneesreceptionprevisionnelle']) ? $data['anneesreceptionprevisionnelle'] : null;
        $this->moisreceptionprevisionnelle = !empty($data['moisreceptionprevisionnelle']) ? $data['moisreceptionprevisionnelle'] : null;
        $this->nummoisreceptionprevisionnelle = !empty($data['nummoisreceptionprevisionnelle']) ? $data['nummoisreceptionprevisionnelle'] : null;
        $this->moisetanneesreceptionprevisionnelle = !empty($data['moisetanneesreceptionprevisionnelle']) ? $data['moisetanneesreceptionprevisionnelle'] : null;
        $this->semainereceptionprevisionnelle  = !empty($data['semainereceptionprevisionnelle']) ? $data['semainereceptionprevisionnelle'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idlogementconcerne'     => $this->idlogementconcerne,
            'datereceptionprevisionnelle' => $this->datereceptionprevisionnelle,
            'anneesreceptionprevisionnelle' =>$this->anneesreceptionprevisionnelle ,
            'moisreceptionprevisionnelle' => $this->moisreceptionprevisionnelle,
            'nummoisreceptionprevisionnelle' => $this->nummoisreceptionprevisionnelle,
            'moisetanneesreceptionprevisionnelle'=> $this->moisetanneesreceptionprevisionnelle,
            'semainereceptionprevisionnelle'  => $this->semainereceptionprevisionnelle,
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
            'name' => 'datereceptionprevisionnelle',
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
            'name' => 'anneesreceptionprevisionnelle',
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
            'name' => 'moisreceptionprevisionnelle',
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
            'name' => 'nummoisreceptionprevisionnelle',
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
            'name' => 'moisetanneesreceptionprevisionnelle',
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
            'name' => 'semainereceptionprevisionnelle',
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