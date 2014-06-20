<?php
namespace Application\Form;

use Zend\Form\Form;
use Components\Form\Element\ButtonWithIcon;
use Components\Form\Element\ButtonIcon;

class ProjectForm extends Form
{

    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('project');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'test'
            ),
            'options' => array(
                'label' => 'Title'
            )
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'Text',
            'options' => array(
                'label' => 'Artist'
            )
        ));
    }

    public function init(){
        $this->add(array(
            'name' => 'submit',
            'type' => 'submitButton',
            'options' => array(
                'label' => 'Submit',
                'icon' => ButtonIcon::ICON_OK
            )
        ));
        $this->add(array(
            'name' => 'cancel',
            'type' => 'cancelButton',
            'options' => array(
                'label' => 'Cancel',
                'icon' => ButtonIcon::ICON_OK
            )
        ));
    }
}