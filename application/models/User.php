<?php
class User extends Zend_Db_Table_Abstract
{
    /**
    * The default table name
    */
    protected $_name = 'user';

    /**
    * isUniqueName
    *
    * @desc check if is unique name
    * @param <string> $name
    */
    public function isUniqueName($name)
    {
        $where = $this->getDefaultAdapter()->quoteInto('name = ?', $name);
        return (count($this->fetchAll($where)) == 0) ? true : false;
    }
}