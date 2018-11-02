<?php

namespace DevisLogement\Form;

use Zend\Form\Form;

class LogementForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Logement');

        //$this->setAttribute('method', 'GET'); // Default is POST

        $this->add([
            'name' => 'idLogement',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'titre',
            'type' => 'Textarea',
            'options' => [
                'label' => 'Titre : ',
            ],
        ]);

        $this->add([
            'name' => 'auteur',
            'type' => 'text',
            'options' => [
                'label' => 'Auteur : ',
            ],

        ]);

        $this->add([
            'name'=>'resume',
            'type'=> 'Textarea',
            'options' => [
                'label' => 'Resumé : ',
            ],
        ]);

        $this->add([
            'name'=>'texte',
            'type'=> 'Textarea',
            'options' => [
                'label' => 'Contenu : ',
            ],
        ]);

        $this->add([
            'name' => 'date',
            'type' => 'hidden',
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