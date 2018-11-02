<?php

namespace DevisLogement\Form;

use Zend\Form\Form;

class joursinterruptionForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('joursinterruption');

        //$this->setAttribute('method', 'GET'); // Default is POST

        $this->add([
            'name' => 'idlogementconcerne',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'nbjoursferies',
            'type' => 'int',
            'options' => [
                'label' => 'nbjoursferies',
            ],
        ]);

        $this->add([
            'name' => 'nbjourscp',
            'type' => 'int',
            'options' => [
                'label' => 'nbjourscp',
            ],

        ]);

        $this->add([
            'name'=>'nbjoursintempérie',
            'type'=> 'int',
            'options' => [
                'label' => 'nbjoursintempérie : ',
            ],
        ]);

        $this->add([
            'name'=>'nbjoursamiante',
            'type'=> 'int',
            'options' => [
                'label' => 'nbjoursamiante : ',
            ],
        ]);

        $this->add([
            'name'=>'nbjoursinterruptionplomb',
            'type'=> 'int',
            'options' => [
                'label' => 'nbjoursinterruptionplomb : ',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}