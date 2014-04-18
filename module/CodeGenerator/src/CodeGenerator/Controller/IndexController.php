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
			$this->getTabelCols($form->get('table_name')->getValue());
			$message = 'Yes';
		}
		return array(
				'message' => $message,
				'form' => $form
		);
	}

	public function getTabelCols( $tableName ){
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

		$metadata = new Metadata($dbAdapter);
		$table = $metadata->getTable($tableName);
		return $table->getColumns();
	}
}