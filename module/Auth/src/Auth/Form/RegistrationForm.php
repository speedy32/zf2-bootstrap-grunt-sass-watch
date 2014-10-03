<?php
namespace Auth\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');
        $labelAttributes = array('class' => 'form-group');
        $this->add(array(
            'name' => 'userName',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' =>'Username',
                'id' => 'userName'
            ),
            'options' => array(
                'label' => 'Username'
            ),

        ));

        $this->add(array(
            'name' => 'userEmail',
            'attributes' => array(
                'type'  => 'email',
                'class' => 'form-control',
                'placeholder' =>'E-mail',
                'id' => 'userEmail'
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));

        $this->add(array(
            'name' => 'userPassword',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'userPassword',
                'placeholder' =>'Password',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Password'
            ),
        ));

        $this->add(array(
            'name' => 'userPasswordConfirm',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'userPasswordConfirm',
                'placeholder' =>'Password',
                'class' => 'form-control'                
            ),
            'options' => array(
                'label' => 'Confirm Password',
            ),
        ));

		$this->add(array(
			'type' => 'Zend\Form\Element\Captcha',
			'name' => 'captcha',
			'options' => array(
				'label' => 'Please verify you are human',
				'captcha' => new \Zend\Captcha\Figlet(),
			),
		));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'
            ),
        ));
    }
}