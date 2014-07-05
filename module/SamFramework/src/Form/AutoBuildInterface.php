<?php
namespace SamFramework\src\Form;

use Zend\ServiceManager\ServiceLocatorInterface;

interface AutoBuildInterface
{
    protected static $serviceLocator;
    public static function getInstance( ServiceLocatorInterface $sl );
}

