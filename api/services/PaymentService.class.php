<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/PaymentsDao.class.php';

class PaymentService extends BaseService{

    private $dao;

    public function __construct(){
       parent::__construct(new PaymentsDao());
    }

}
?> 