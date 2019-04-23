<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
    date_default_timezone_set('Asia/Phnom_Penh');
  }

  private function getToken($length, $seed){    
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
  private function promotion_code($id) { 
      $token = $this->getToken(6, $id);
      $code = 'PO'. $token . strtotime("now");
      return $code;
  }

  public function index() {
    dd('Implement payment method here!');
  }
}
