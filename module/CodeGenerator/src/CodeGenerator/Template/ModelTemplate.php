<?php
namespace CodeGenerator\Template;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ModelTemplate implements InputFilterAwareInterface
{


    /*
     * (non-PHPdoc) @see \Zend\InputFilter\InputFilterAwareInterface::setInputFilter()
     */
    public function setInputFilter()
    {
        throw new \Exception("Not used");
    }

    /*
     * (non-PHPdoc) @see \Zend\InputFilter\InputFilterAwareInterface::getInputFilter()
     */
    public function getInputFilter()
    {
         throw new \Exception("Not used");
    }
}
