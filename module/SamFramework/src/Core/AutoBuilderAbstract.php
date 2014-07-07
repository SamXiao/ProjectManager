<?php
namespace SamFramework\src\Core;

use Zend\ServiceManager\ServiceLocatorInterface;
use SamFramework\src\AutoBuildInterface;

abstract class AutoBuilderAbstract implements AutoBuildInterface
{
    protected $_serviceLocator;

    public static function getInstance( ServiceLocatorInterface $sl );

}

