<?php

class Application_Form_Guestbook extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        // set method for display form to post
        $this->setAction('guestbook/process')
             ->setMethod('post');
        
        // add email element
        $this->addElement('text','email',array(
            'label' => 'Your Email Address:',
            'required' => true, 
            'filters' => array('stringTrim'), 
            'validators' => array(
                'EmailAddress',
                )
            ));
        // add comment element
        $this->addElement('textarea','comment',  array(
            'label' => 'Please Comment',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 20))
            )
        ));
        // add captcha
        $this->addElement('captcha', 'captcha', array(
            'label' => 'Please enter the following 5 letters below:',
            'required' => true,
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordlen' => 5,
                'timeout' => 300
            )
        ));
        // add submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Sign Guestbook',
        ));
        // add CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }


}