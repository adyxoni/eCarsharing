<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/VehiclesDao.class.php';

class VehicleService extends BaseService{

    private $dao;

    public function __construct(){
       parent::__construct(new VehiclesDao());
    }

}
?>