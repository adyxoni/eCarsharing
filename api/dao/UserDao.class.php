<?php
require_once __DIR__.'/BaseDao.class.php';

class VehiclesDao extends BaseDao{


  public function __construct(){
    parent::__construct("vehicles");
  }

  public function get_user_by_email($email)  {
    return $this->query_unique("SELECT * FROM users WHERE email=:email", ["email" => $email]);
  }

  public function update_user_by_email($email, $user) {
    $this->update("users", $email, $user, "email");
  }
  public function get_user_by_token($token){
    return $this->query_unique("SELECT * FROM users WHERE token=:token",["token"=> $token]);
  }

}