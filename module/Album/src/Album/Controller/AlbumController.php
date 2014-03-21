<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Project; // <-- Add this import
use Album\Form\ProjectForm; // <-- Add this import
class AlbumController extends AbstractActionController
{

    protected $projectTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'projects' => $this->getProjectTable()->fetchAll()
        ));
    }

    public function addAction()
    {
        $form = new ProjectForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Project();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getProjectTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array(
            'form' => $form
        );
    }

    public function editAction()
    {}

    public function deleteAction()
    {}

    public function getProjectTable()
    {
        if (! $this->projectTable) {
            $sm = $this->getServiceLocator();
            $this->projectTable = $sm->get('Album\Model\ProjectTable');
        }
        return $this->projectTable;
    }
}