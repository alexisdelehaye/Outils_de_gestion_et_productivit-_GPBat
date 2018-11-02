<?php


namespace DevisLogement\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

class oprconfirmeeForm extends Form
{


    public function __construct()
    {
        parent::__construct('oprconfirmee');

        // Set POST method for this form
        //  $this->setAttribute('method', 'post');


        $this->add([
            'name' => 'idlogementconcerne',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'datesoprconfirme',
            'type' => 'Date',
            'options' => [
                'label' => 'datesoprconfirme',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id' => 'submitbutton',
            ],
        ]);

    }

}
