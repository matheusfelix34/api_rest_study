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

   public function store(Request $request){
    $data =$request->all();
    $product= $this->product->create($data);
    return response()->json($product);

   }

   public function show($id){
    $product=$this->product->find($id);
     return response()->json($product);
   }

   public function update2($id,$name){
    $product=$this->product->find($id);
    $product->update(
        ['name'=>$name]
    );
     return response()->json($product);
   }

    public function update(Request $request){

    $data=$request->all();
    $product=$this->product->find($data['id']);

        $product->update(
          $data
        );

    return response()->json($product);

    }


}
