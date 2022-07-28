<?php
require_once __DIR__.'/BaseDao.class.php';

class TodosDao extends BaseDao{

    public function __construct(){
        parent::__construct("todos");
    }
}