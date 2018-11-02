<?php

namespace DevisLogement\Models;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;
use Zend\Validator\StringLength;

class pafi implements InputFilterAwareInterface
{
    public $idpafi;
    public $idlogementconcerne;
    public $etatenvoiepafi;
    public $dateenvoiepafi;
    public $dateprevisionnelleretourpafi;
    public $retourpafi;
    public $datereelretourpafi;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->idpafi    = !empty($data['idpafi']) ? $data['idpafi'] : null;
        $this->idlogementconcerne    = !empty($data['idlogementconcerne']) ? $data['idlogementconcerne'] : null;
        $this->etatenvoiepafi= !empty($data['etatenvoilogement']) ? $data['etatenvoilogement'] : null;
        $this->dateenvoiepafi = !empty($data['dateenvoiepafi']) ? $data['dateenvoiepafi'] : null;
        $this->dateprevisionnelleretourpafi = !empty($data['dateprevisionnelleretourpafi']) ? $data['dateprevisionnelleretourpafi'] : null;
        $this->retourpafi = !empty($data['retourpafi']) ? $data['retourpafi'] : null;
        $this->datereelretourpafi  = !empty($data['datereelretourpafi']) ? $data['datereelretourpafi'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'idpafi'     => $this->idpafi,
            'idlogementconcerne' => $this->idlogementconcerne,
            'etatenvoiepafi' =>$this->etatenvoiepafi ,
            'dateenvoiepafi' => $this->dateenvoiepafi,
            'dateprevisionnelleretourpafi' => $this->dateprevisionnelleretourpafi,
            'retourpafi'  => $this->retourpafi,
            'datereelretourpafi' =>$this->datereelretourpafi,
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
            'name' => 'idpafi',
            'required' => false,
        ]);

        $inputFilter->add([
            'name' => 'idlogementconcerne',
            'required' => false,
        ]);

        $inputFilter->add([
            'name' => 'etatenvoiepafi',
            'required' => false,

        ]);

        $inputFilter->add([
            'name' => 'dateenvoiepafi',
            'required' => false,

        ]);

        $inputFilter->add([
            'name' => 'dateprevisionnelleretourpafi',
            'required' => false,

        ]);

        $inputFilter->add([
            'name' => 'retourpafi',
            'required' => false,

        ]);

        $inputFilter->add([
            'name' => 'datereelretourpafi',
            'required' => false,

        ]);

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }


}