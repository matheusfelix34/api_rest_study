<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealState extends Model
{
    use HasFactory;


    protected     $table = 'real_state';

    protected     $fillable = [

            'user_id',
            'title',
            'description',
            'content',
            'price',
            'slug',
            'bathrooms',
            'bedrooms',
            'property_area',
            'total_property_area',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
      
        return $this->belongsToMany(Category::class,'real_state_categories');
    }

    public function photos(){
        return $this->hasMany(RealStatePhoto::class);
    }

}
