<?php

namespace App\Secure;

class Secure
{
  private $private_key;
  
  public function setPrivateKey($key){}
  
  public function getPrivateKey(){}
  
  public function verifyHash($pass, $hash){}
  
  public function hash_pass($pass){
    $hash = password_hash($pass, PASSWORD_BCRYPT, array('salt' => $this->private_key));
    
    return $hash;
  }
}
