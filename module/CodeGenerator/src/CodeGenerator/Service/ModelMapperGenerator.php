<?php
namespace CodeGenerator\Service;

use Zend\Code\Generator\ParameterGenerator;

class ModelMapperGenerator extends AbstractGenerator
{

    protected $templateClassName = 'CodeGenerator\Template\ModelMapperTemplate';

    protected $modelClassName;

    public function setClassName($className)
    {
        $this->className = ucfirst(trim($className, '\\')) . 'Table';
        $this->setModelClassName($className);
    }

    /**
     *
     * @return the $modelClassName
     */
    public function getModelClassName()
    {
        return $this->modelClassName;
    }

    /**
     *
     * @param fieldtype $modelClassName
     */
    public function setModelClassName($modelClassName)
    {
        $this->modelClassName = ucfirst(trim($modelClassName, '\\'));
    }

    /**
     *
     * @return \CodeGenerator\Service\ClassGenerator
     */
    public function generate()
    {
        $this->generateProperties();
        $this->generateGetModelMethod();
        $this->generateSaveModelMethod();
        $this->generateDeleteMethod();
        $this->writeClassToFile();
    }

    protected function generateProperties()
    {
        $classGenerator = $this->getClassGenerator();
        $modelClassFullName = $this->getNamespace() . '\\' . $this->getModelClassName();
//         $classGenerator->getProperty('TABLE_NAME')->setDefaultValue($this->tableName);
//         $classGenerator->getProperty('MODEL_CLASS_NAME')->setDefaultValue($modelClassFullName);
    }

    protected function generateGetModelMethod()
    {
        $classGenerator = $this->getClassGenerator();
        $methodGenerator = $classGenerator->getMethod('getModel');
        $methodGenerator->setName('get' . $this->getModelClassName());
    }

    protected function generateSaveModelMethod()
    {
        $classGenerator = $this->getClassGenerator();
        $methodGenerator = $classGenerator->getMethod('saveModel');
        $methodGenerator->setName('save' . $this->modelClassName);
        $methodGenerator->setParameter(new ParameterGenerator(lcfirst($this->getModelClassName()), $this->getModelClassName()));
        $body = $methodGenerator->getBody();
        $body = str_replace('$model', '$' . $this->getModelClassName(), $body);
        $body = str_replace('getModel', 'get' . $this->getModelClassName(), $body);
        $methodGenerator->setBody($body);
    }

    protected function generateDeleteMethod()
    {
        $classGenerator = $this->getClassGenerator();
        $methodGenerator = $classGenerator->getMethod('deleteModel');
        $methodGenerator->setName('delete' . $this->modelClassName);
        $methodGenerator->setParameter(new ParameterGenerator('id'));
    }
}

