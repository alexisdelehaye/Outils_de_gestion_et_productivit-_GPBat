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

class datamaisonetcites implements InputFilterAwareInterface
{
    public $numeroarticle;
    public $libellearticle;
    public $un;
    public $puht;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->numeroarticle    = !empty($data['numeroarticle']) ? $data['numeroarticle'] : null;
        $this->libellearticle    = !empty($data['libellearticle']) ? $data['libellearticle'] : null;
        $this->un= !empty($data['un']) ? $data['un'] : null;
        $this->puht = !empty($data['puht']) ? $data['puht'] : null;

    }

    public function getArrayCopy()
    {
        return [
            'numeroarticle'     => $this->numeroarticle,
            'libellearticle' => $this->libellearticle,
            'un' =>$this->un,
            'puht' => $this->puht,
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
            'name' => 'numeroarticle',
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
                        'max'=>15
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'libellearticle',
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
                        'max' => 10,
                    ],
                ],
            ],
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