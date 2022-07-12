<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TasksDao.class.php';

class TaskService extends BaseService{

    private $dao;

    public function __construct(){
       parent::__construct(new TasksDao());
    }

}
?>