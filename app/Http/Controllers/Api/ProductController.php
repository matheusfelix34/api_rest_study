<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

   public function __construct(Product $product) {
    $this->product = $product;
   }

   public function index(){
    return response($this->product::all());
   }

}
