<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setName('album');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'artist',
            'type' => 'Text',
            'options' => array(
                'label' => 'Artist',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'options' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}
