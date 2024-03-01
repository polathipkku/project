<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "product_type_name"
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'product_types_id');
    }
}
