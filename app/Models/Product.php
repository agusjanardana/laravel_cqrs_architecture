<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
        protected $connection = 'command';
        protected $table = 'products';

     protected $fillable = [
        "product_name",
        "stock",
        "price",
    ];
}