<?php
namespace SamFramework\src\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SamFramework\src\Core\AutoBuildInterface;

class FormAbstractFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName( ServiceLocatorInterface $serviceLocator, $name, $requestedName )
    {
        if ( class_exists( $requestedName ) ) {
            $class = new \ReflectionClass( $requestedName );
            if ( $class->implementsInterface( 'SamFramework\src\Core\AutoBuildInterface' ) ) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName( ServiceLocatorInterface $serviceLocator, $name, $requestedName )
    {
        return $requestedName::getInstance( $serviceLocator );
    }
}

