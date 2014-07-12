<?php
namespace SamFramework\src\Model;

use Zend\Db\TableGateway\AbstractTableGateway as ZDTA;
use Zend\Db\TableGateway\Feature\FeatureSet;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Adapter\Exception\InvalidArgumentException;
use Zend\Db\TableGateway\Feature\AbstractFeature;

class TableGateway extends ZDTA
{

    /**
     * Constructor
     *
     * @param string $table
     * @param AdapterInterface $adapter
     * @param Feature\AbstractFeature|Feature\FeatureSet|Feature\AbstractFeature[] $features
     * @param ResultSetInterface $resultSetPrototype
     * @param Sql $sql
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($table, $features = null, ResultSetInterface $resultSetPrototype = null, Sql $sql = null)
    {
        // table
        if (! (is_string($table) || $table instanceof TableIdentifier)) {
            throw new InvalidArgumentException('Table name must be a string or an instance of Zend\Db\Sql\TableIdentifier');
        }
        $this->table = $table;

        // process features
        if ($features !== null) {
            if ($features instanceof AbstractFeature) {
                $features = array(
                    $features
                );
            }
            if (is_array($features)) {
                $this->featureSet = new FeatureSet($features);
            } elseif ($features instanceof FeatureSet) {
                $this->featureSet = $features;
            } else {
                throw new InvalidArgumentException('TableGateway expects $feature to be an instance of an AbstractFeature or a FeatureSet, or an array of AbstractFeatures');
            }
        } else {
            $this->featureSet = new FeatureSet();
        }

        $this->featureSet->addFeature(new GlobalAdapterFeature());

        // result prototype
        $this->resultSetPrototype = ($resultSetPrototype) ?  : new ResultSet();

        // Sql object (factory for select, insert, update, delete)
        $this->sql = ($sql) ?  : new Sql($this->adapter, $this->table);

        // check sql object bound to same table
        if ($this->sql->getTable() != $this->table) {
            throw new InvalidArgumentException('The table inside the provided Sql object must match the table of this TableGateway');
        }

        $this->initialize();
    }
}

