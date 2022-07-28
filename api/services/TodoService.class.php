<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TodosDao.class.php';

class TodoService extends BaseService{

    private $dao;

    public function __construct(){
       parent::__construct(new TodosDao());
    }

}
?>