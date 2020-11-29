<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public $idproduct = NULL;
    public $Titleproduct = "";
    public $idsize = NULL;
    public $Amount = 0;
    public $price = 0;

    public function __construct($cart)
    {
        $this->idproduct = $cart->idproduct;
        $this->Titleproduct = $cart->Titleproduct;
        $this->idsize = $cart->TitleSize;
        $this->Amount = $cart->Amount;
        $this->price = $cart->idproduct;
    }
    public function addCart($cart){
            Session::put("Cart.$cart->idsize", $cart);
    }
}
