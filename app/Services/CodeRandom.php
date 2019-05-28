<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class CodeRandom extends Model
{
    public function getToken($length, $seed){    
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
    
        mt_srand($seed);      // Call once. Good since $product_id is unique.
    
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
      }
      // Random string 
    public function code($prefix="",$id=0) { 
          $token = $this->getToken(6, $id);
          $code = $prefix. $token;
          return $code;
      }
}
