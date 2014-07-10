<?php
namespace CodeGenerator\Service;

abstract class AbstractGenerator
{
    protected  $_namespace;
    protected  $_className;
    protected  $_tableName;
    protected  $_fileName;

	/**
     * @return the $_namespace
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

	/**
     * @return the $_className
     */
    public function getClassName()
    {
        return $this->_className;
    }

	/**
     * @return the $_tableName
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

	/**
     * @param field_type $_namespace
     */
    public function setNamespace( $_namespace )
    {
        $this->_namespace = $_namespace;
    }

	/**
     * @param field_type $_className
     */
    public function setClassName( $_className )
    {
        $this->_className = $_className;
    }

	/**
     * @param field_type $_tableName
     */
    public function setTableName( $_tableName )
    {
        $this->_tableName = $_tableName;
    }


    /**
     * @return the $_fileName
     */
    public function getFileName()
    {
        if ( !$this->_fileName ) {
        	$fileName = ;
        }
        return $this->_fileName;
    }

	/**
     * @param field_type $_fileName
     */
    public function setFileName( $_fileName )
    {
        $this->_fileName = $_fileName;
    }

	protected function getClassByFileName()
    {

    }

    protected function writeClassToFile(){

    }
}

