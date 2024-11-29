<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //customizado  
        return parent::toArray($request);

        //nao customizado
        //return $this->resource->ToArray();
       /* return [
            'slug' => $this->slug
        ];*/
    }

    public function with($request){
        return [
            'extra_info' => 'outra_data'
        ];
    }
}
