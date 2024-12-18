<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    private $product;

   public function __construct(Product $product) {
    $this->product = $product;
   }

   public function index(Request $request){
    
    $products = $this->product;
    $productRepository=new ProductRepository($products);
     
     
      if ($request->has('conditions')) {
        $productRepository->selectConditions($request->get('conditions'));
      }
      
    
      if ($request->has('fields')) {
      
        $productRepository->selectFilter($request->get('fields'));
  
      }
     
          

    
      return new ProductCollection($productRepository->getResult()->paginate(10));
     // return new ProductCollection($products->paginate(10));
   }

   public function store(Request $request){
    $data =$request->all();
    $product= $this->product->create($data);
    return response()->json($product);

   }

   public function show($id){
    $product=$this->product->find($id);
    // return response()->json($product);
       return new ProductResource($product);
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

    public function delete($id){

      Product::destroy($id);
      return response() ->json(['data'=> 'Produto removido com sucesso!']);
    }


}
