<?php
namespace Components\Form\Element;

use Zend\Form\Element\Button;

class CancelButton extends Button implements ElementWithIconInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'button',
        'class' => 'btn btn-light'
    );

	/* (non-PHPdoc)
     * @see \Components\Form\Element\ElementWithIconInterface::getDefaultIcon()
     */
    protected function getDefaultIcon()
    {
        // TODO Auto-generated method stub
        return ButtonIcon::ICON_CANCEL;
    }

}

