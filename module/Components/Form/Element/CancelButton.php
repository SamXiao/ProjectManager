<?php
namespace Components\Form\Element;

use Zend\Form\Element\Button;

class CancelButton extends Button
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'button',
        'class' => 'btn btn-info'
    );

    /**
     * @var array custom options
     */
    protected $options = array();
}

