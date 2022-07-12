<?php
require_once __DIR__.'/BaseDao.class.php';

class TasksDao extends BaseDao{


  public function __construct(){
    parent::__construct("tasks");
    }
}
