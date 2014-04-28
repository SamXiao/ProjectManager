<?php
namespace CodeGenerator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CodeGenerator\Form\ModelForm;
use Zend\Db\Metadata\Metadata;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Reflection\FileReflection;
use Zend\Code\Reflection\ClassReflection;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return false;
    }

    public function modelAction()
    {
        $message = '';
        $form = new ModelForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $message = 'Yes';
            $this->generateModelFile($form);
        }
        return array(
            'message' => $message,
            'form' => $form
        );
    }

    protected function generateModelFile($form)
    {
        $nameSpace = $form->get('namespace')->getValue();
        $className = $form->get('model_class')->getValue();
        $tableName = $form->get('table_name')->getValue();
        $fileName = $form->get('path')->getValue() . '/' . $className . '.php';

        if (file_exists($fileName)) {
            $class = FileGenerator::fromReflection(new ClassReflection($nameSpace));
        } else {
            $class = ClassGenerator::fromReflection(new ClassReflection('CodeGenerator\Template\Model'));
        }

        $class->setName($className);
        $class->setNamespaceName($nameSpace);

        $cols = $this->getTabelCols($tableName);
        $exchangeArrayBody = '';
        foreach ($cols as $col) {
            if (! $class->hasProperty($col->getName())) {
                $class->addProperty($col->getName(), '', 'public');
            }
            $exchangeArrayBody .= '$this->' . $col->getName() . ' = (!empty($data[\'' . $col->getName() . '\'])) ? $data[\'' . $col->getName() . '\'] : null;';
        }

        $method = new MethodGenerator();
        $method->setName('exchangeArray')
            ->setParameter('data')
            ->setBody($exchangeArrayBody);
        $class->setMethod($method);

        $file = new FileGenerator();
        $file->setClass($class);
        file_put_contents($fileName, $file->generate());
    }

    protected function getTabelCols($tableName)
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $metadata = new Metadata($dbAdapter);
        $table = $metadata->getTable($tableName);
        return $table->getColumns();
    }
}