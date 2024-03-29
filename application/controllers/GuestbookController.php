<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        /*$guestbook = new Application_Model_Guestbook();
        $this->view->entries = $guestbook->fetchAll();*/
       $rslt = Application_Model_Guestbook::findAll(); 
       $this->view->gb_table = Application_Model_Guestbook::build_gb_table($rslt);
    }

    public function signAction() {
        // action body
        $request = $this->getRequest();
        $form    = new Application_Form_Guestbook();
        
        if($this->getRequest()->isPost()) {
            if($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $comment->saveComment($comment);
                return $this->_helper->redirector('index');
            } // form does not validate
        } // No POST 
        // we need to display the form
        $this->view->form = $form;
    }


}



