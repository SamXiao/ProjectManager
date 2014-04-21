<?php

namespace CodeGenerator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CodeGenerator\Form\ModelForm;
use Zend\Db\Metadata\Metadata;
use Album\Form\ProjectForm;

class IndexController extends AbstractActionController {
	public function indexAction() {
		return false;
	}

	public function modelAction() {
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
	protected function generateModelFile($form){
	    $class = \Zend\Code\Generator\ClassGenerator::fromReflection(
	        new \Zend\Code\Reflection\ClassReflection('CodeGenerator\Template\Model')
	    );
	    $class->setName($form->get('model_class')->getValue());
        $cols = $this->getTabelCols($form->get('table_name')->getValue());

        foreach ($cols as $col){
            $class->addProperty($col->getName(), '', 'public');
        }


// 	    $method = new Zend\Code\Generator\MethodGenerator();
// 	    $method->setName('mrMcFeeley')
// 	    ->setBody('echo \'Hello, Mr. McFeeley!\';');
// 	    $class->setMethod($method);

	    $file = new \Zend\Code\Generator\FileGenerator();
	    $file->setClass($class);

	    // Render the generated file
// 	    echo $file;

	    // Or, better yet, write it back to the original file:
	    file_put_contents('test.php', $file->generate());
	}

	protected  function getTabelCols( $tableName ){
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

		$metadata = new Metadata($dbAdapter);
		$table = $metadata->getTable($tableName);
		return $table->getColumns();
	}
}