<?php
namespace SamFramework\src\Form;

use Zend\ServiceManager\ServiceLocatorInterface;

interface AutoBuildInterface
{
    public function getInstance( ServiceLocatorInterface $sl );
}

