<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'qty',
        'category_id',
        'supplier_id',
        'godaun',
        'Product_Route',
        'buying_date',
        'expire_date',
        'buying_price',
        'selling_price' ,
        'image',
        'description',
        'status'
    ];
}
