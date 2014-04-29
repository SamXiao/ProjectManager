<?php
namespace CodeGenerator\Service;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Db\Metadata\Metadata;

class ModelMapperGenerator
{

    public $nameSpace;

    public $className;

    public $modelClassName;

    public $tableName;

    protected $tableCols;

    protected $dbAdapter;

    protected $_fetchAllMethodTemplate = '$resultSet = $this->tableGateway->select();
return $resultSet;';

    protected $_toArrayMethodTemplate = '(!empty($this-><{$colName}>)) ? $data[\'<{$colName}>\'] = $this-><{$colName}> : null;';

    public function __construct($dbAdapter, $modelName, $nameSpace, $tableName)
    {
        $this->dbAdapter = $dbAdapter;
        $this->className = $modelName . 'Table';
        $this->modelClassName = $modelName;
        $this->nameSpace = $nameSpace;
        $this->tableName = $tableName;
    }

    /**
     *
     * @return \CodeGenerator\Service\ClassGenerator
     */
    public function generate()
    {
        $class = new ClassGenerator($this->className, $this->nameSpace);

        $class->addUse('Zend\Db\TableGateway\TableGateway');
        $class->addProperty('tableGateway', null, 'protected');

        $class->addMethodFromGenerator($this->generateConstructMethod());
        $class->addMethodFromGenerator($this->generateFetchAllMethod());
        $class->addMethodFromGenerator($this->generateGetModelMethod());
        $class->addMethodFromGenerator($this->generateSaveModelMethod());

        return $class;
    }

    protected function generateConstructMethod()
    {
        $method = new MethodGenerator();
        $method->setName('__construct');
        $method->setParameter(new ParameterGenerator('tableGateway', 'TableGateway'));
        $method->setBody('$this->tableGateway = $tableGateway;');
        return $method;
    }

    protected function generateFetchAllMethod()
    {
        $method = new MethodGenerator();
        $method->setName('fetchAll');
        $method->setBody($this->_fetchAllMethodTemplate);
        return $method;
    }

    protected function getTabelCols()
    {
        if (empty($this->tableCols)) {
            $metadata = new Metadata($this->dbAdapter);
            $table = $metadata->getTable($this->tableName);
            $this->tableCols = $table->getColumns();
        }
        return $this->tableCols;
    }

    protected function generateGetModelMethod()
    {
        $method = new MethodGenerator();
        $method->setName('get' . $this->modelClassName);
        $body = '$id  = (int) $id;
 $rowset = $this->tableGateway->select(array(\'id\' => $id));
 $row = $rowset->current();
 if (!$row) {
     throw new \Exception("Could not find row $id");
 }
 return $row;';
        $method->setBody($body);
        return $method;
    }

    protected function generateSaveModelMethod()
    {
        $method = new MethodGenerator();
        $method->setName('get' . $this->modelClassName);
        $body = '$id  = (int) $id;
 $rowset = $this->tableGateway->select(array(\'id\' => $id));
 $row = $rowset->current();
 if (!$row) {
     throw new \Exception("Could not find row $id");
 }
 return $row;';
        $method->setBody($body);
        return $method;
    }
}

