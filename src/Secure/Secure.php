<?php

namespace App\Secure;

class Secure
{
  private $options = array();
  private $private_key;
  
  public function setPrivateKey(string $key){
    $this->private_key = $key;
  }
  
  public function getPrivateKey(){
    return $this->private_key;
  }
  
  public function verifyHash(string $pass, string $hash){
      return password_verify($pass, $hash);
  }
    
  public function setOptions(array $options){
      $this->options = $options;
  }
  
  public function hash_pass(string $pass){
    $hash = password_hash($pass, PASSWORD_BCRYPT, $this->options);
    return $hash;
  }
}