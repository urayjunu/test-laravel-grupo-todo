<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // $category->products
    public function productos()
    {
    	return $this->hasMany(Product::class);	
    }

}
