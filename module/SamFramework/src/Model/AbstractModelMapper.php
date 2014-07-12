<?php
namespace SamFramework\src\Model;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\ResultSet;
use SamFramework\src\Core\AbstractAutoBuilder;

abstract class AbstractModelMapper extends AbstractAutoBuilder
{

    const MODEL_CLASS_NAME = NULL;
    protected static $className = __CLASS__;
    protected $tableGateway = null;

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

        $currentClass = get_called_class();
        $instance = new $currentClass();


        $resultSetPrototype = new ResultSet();
        $modelClass = static::MODEL_CLASS_NAME;
        $resultSetPrototype->setArrayObjectPrototype(new $modelClass());

        $instance->setTableGateway( new TableGateway(static::TABLE_NAME, null, $resultSetPrototype) );
        return $instance;
    }

}

