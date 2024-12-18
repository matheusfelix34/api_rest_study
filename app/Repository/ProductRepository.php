<?php

namespace App\Repository;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductRepository 
{
   
    private $model;

    private $teste;

    public function __construct(Product $model)
    {
        $this->model = $model;
      
    }

    public function set_teste($valor){
        $this->teste = $valor;
    }


    public function get_teste(){
        return $this->teste ;
    }

    public  function selectFilter($fields){
        $this->model= $this->model->selectRaw($fields);
    }

    public function selectConditions($conditions){
        $expressions = explode(';',$conditions) ;
        
        foreach ($expressions as $e) {
            $exp= explode(':',$e);
            $this->model=  $this->model->where($exp[0], $exp[1], $exp[2]);
        }

       
    }

    public function getResult(){
            return $this->model;
    }

}
