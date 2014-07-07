<?php
namespace SamFramework\src\Core;

use Zend\ServiceManager\ServiceLocatorInterface;

interface AutoBuildInterface
{
    public static function getInstance( ServiceLocatorInterface $sl );
}

