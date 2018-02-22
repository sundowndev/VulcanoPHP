<?php

namespace App\Secure;

class Secure
{
  private $options = [];
  
  public function verifyHash(string $pass, string $hash)
  {
      return password_verify($pass, $hash);
  }
    
  public function setOptions(array $options)
  {
      $this->options = $options;
  }
  
  public function hash_pass(string $pass)
  {
    $hash = password_hash($pass, PASSWORD_BCRYPT, $this->options);
    return $hash;
  }
}