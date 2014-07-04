<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthDbTableAdapter;

class LoginForm extends Form
{
    public static function getInstance( ServiceLocatorInterface $sl){
        return $sl->get('FormElementManager')->get('\Application\Form\LoginForm');
    }

    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'UserName'
            )
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password'
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton'
            )
        ));
    }

    public function init(){
        $this->add(array(
            'name' => 'submit',
            'type' => 'submitButton',
            'options' => array(
                'label' => 'Submit',
            )
        ));
        $this->add(array(
            'name' => 'cancel',
            'type' => 'cancelButton',
            'options' => array(
                'label' => 'Cancel',
            )
        ));
    }

    public function doAuth()
    {
        $auth = new AuthenticationService();

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $authAdapter = new AuthDbTableAdapter($dbAdapter, 'core_member', 'username', 'password');
        $authAdapter->setIdentity( $this->get('name') );
        $authAdapter->setCredential( $this->get('password') );

        // Attempt authentication, saving the result
        $result = $auth->authenticate($authAdapter);
        return $result;
    }
}