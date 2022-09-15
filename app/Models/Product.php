<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $id = 'id';

    public function productImages(){
        return $this->hasbelongsTo('App\Models\ProductImages');
    }
}
