<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Auth\Entity\User; // only for the filters
use Auth\Form\LoginForm;       // <-- Add this import
use Auth\Form\LoginFilter;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	//$em = $this->getEntityManager();
        //$users = $em->getRepository('Auth\Entity\User')->findAll();
    	$users = array();
        $message = $this->params()->fromQuery('message', 'foo');

        // W zależności od formatu wyślij dane w takim formacie 
        switch ($this->params('format')) 
        {
            case 'json':
                $users = array();
                foreach ($users as $user) {
                    $usersData[] = $user->toArray();
                }
                return new JsonModel(array(
                    'success' => true
                    , 'users' => $users
                    , 'message' => $message
                ));
            default:
                return new ViewModel(array(
					'message' => $message
					, 'users'	=> $users

                ));
        }
    }

	public function loginAction()
	{
		$form = new LoginForm();
		$form->get('submit')->setValue('Login');
		$messages = null;

		$request = $this->getRequest();
        if ($request->isPost()) {

			// Filters have been fixed
			$form->setInputFilter(new LoginFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
			// echo "<h1>I am here1</h1>";
            if ($form->isValid()) {
				$data = $form->getData();
				// $data = $this->getRequest()->getPost();

				// If you used another name for the authentication service, change it here
				// it simply returns the Doctrine Auth. This is all it does. lets first create the connection to the DB and the Entity
				$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
				// Do the same you did for the ordinar Zend AuthService
				$adapter = $authService->getAdapter();
				$adapter->setIdentityValue($data['username']); //$data['usr_name']
				$adapter->setCredentialValue($data['password']); // $data['usr_password']
				$authResult = $authService->authenticate();
				// echo "<h1>I am here</h1>";
				if ($authResult->isValid()) {
					$identity = $authResult->getIdentity();
					$authService->getStorage()->write($identity);
					
					// 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
					$time = 1209600; 
					if ($data['rememberme']) {
						$sessionManager = new \Zend\Session\SessionManager();
						$sessionManager->rememberMe($time);
					}
					//- return $this->redirect()->toRoute('home');
				}
				foreach ($authResult->getMessages() as $message) {
					$messages .= "$message\n";
				}

			}
		}
		return new ViewModel(array(
			'error' => 'Your authentication credentials are not valid',
			'form'	=> $form,
			'messages' => $messages,
		));
    }
}
