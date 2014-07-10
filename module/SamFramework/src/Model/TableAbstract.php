<?php
namespace SamFramework\src\Model;

use SamFramework\src\Core\AutoBuildInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;;

abstract class TableAbstract implements AutoBuildInterface
{

    const TABLE_NAME = NULL;
    const MODEL_CLASS_NAME = NULL;
    protected static $className = __CLASS__;
    protected $serviceLocator = null;
    protected $tableGateway = null;

    /**
     *
     * @return ServiceLocatorInterface $serviceLocator
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     *
     * @return TableGateway $tableGateway
     */
    public function getTableGateway()
    {
        return $this->tableGateway;
    }

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator( ServiceLocatorInterface $serviceLocator )
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     *
     * @param TableGateway $tableGateway
     */
    public function setTableGateway( TableGateway $tableGateway )
    {
        $this->tableGateway = $tableGateway;
    }

    /*
     * (non-PHPdoc) @see \SamFramework\src\Core\AutoBuildInterface::getInstance()
     */
    public static function getInstance( ServiceLocatorInterface $sl )
    {
        if ( static::TABLE_NAME === null ) {
            throw new \Exception('You must setup TABLE_NAME', 500);
        }
        if ( static::MODEL_CLASS_NAME === null ) {
            throw new \Exception('You must setup MODEL_CLASS_NAME', 500);
        }
        $instance = static::createNewInstance();
        $instance->setServiceLocator( $sl );
        $dbAdapter = $sl->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new ResultSet();
        $modelClass = static::MODEL_CLASS_NAME;
        $resultSetPrototype->setArrayObjectPrototype(new $modelClass());

        $instance->setTableGateway( new TableGateway(static::TABLE_NAME, $dbAdapter, null, $resultSetPrototype) );
        return $instance;
    }

    /**
     * @return TableAbstract $instance
     */
    protected static function createNewInstance()
    {
        $currentClass = get_called_class();
        $instance = new $currentClass();
        return $instance;
    }
}

