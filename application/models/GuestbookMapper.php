<?php

class Application_Model_GuestbookMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable) {
        if(is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table gateway provided'); 
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbTable() {
        if(null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Guestbook');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Guestbook $guestbook) {
        $data = array(
                    'email' => $guestbook->getEmail(),
                    'comment' => $guestbook->getComment(),
                    'created' => date('Y-m-d H:i:s'),
        );
        if(null === ($id = $guestbook->getID())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?'=>$id));
        }
    }
    
    public function find($id, Application_Model_Guestbook $guestbook) {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result)){
            return;
        }
        $row = $result->current();
        $guestbook->setID($row->id)
                  ->setEmail($row->email)
                  ->setComment($row->comment)
                  ->setCreated($row->created);
    }
    
    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            foreach ($row as $key => $value) {
                $method = 'set' . ucfirst($key);
                $entry->$method($value);
            }
            $entries[] = $entry;
        }   
        return $entries;
    }
}