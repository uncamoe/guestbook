<?php

class AboutController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->view->email = Application_Model_Guestbook::getEmail($this->getRequest()->getParam('id'));
    }

    /*public function usAction()
    {
        // action body
       $rslt = Application_Model_Guestbook::findAll(); 
       $this->view->gb_table = Application_Model_Guestbook::build_gb_table($rslt);  
    }*/
}