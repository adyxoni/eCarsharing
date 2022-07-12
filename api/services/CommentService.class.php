<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/CommentsDao.class.php';

class CommentService extends BaseService{

    private $dao;

    public function __construct(){
       parent::__construct(new CommentsDao());
    }

}
?>