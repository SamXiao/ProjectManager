<?php
namespace SamFramework\src\Core;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class AbstractAutoBuilder implements AutoBuildInterface, ServiceLocatorAwareInterface
{
    protected $service_manager;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->service_manager = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->service_manager;
    }


    public static function getInstance( ServiceLocatorInterface $serviceLocator );

}

