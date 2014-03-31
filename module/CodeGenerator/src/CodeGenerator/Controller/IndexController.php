<?php

namespace CodeGenerator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use CodeGenerator\Form\ModelForm;

class IndexController extends AbstractActionController {
	public function indexAction() {
		return false;
	}

	public function modelAction() {
		$message = '';
		$form = new ModelForm();
		$form->get('submit')->setValue('Add');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$message = 'Yes';
			}
		}
		return array(
				'message' => $message,
				'form' => $form
		);
	}
}