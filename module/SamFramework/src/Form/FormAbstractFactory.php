<?php
namespace SamFramework\src\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormAbstractFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName( ServiceLocatorInterface $serviceLocator, $name, $requestedName )
    {
        if ( class_exists( $requestedName ) ) {
            $class = new \ReflectionClass( $requestedName );
            if ( $class->implementsInterface( 'SamFramework\src\Form\AutoBuildInterface' ) ) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName( ServiceLocatorInterface $serviceLocator, $name, $requestedName )
    {
        return new $requestedName( $serviceLocator );
    }
}

