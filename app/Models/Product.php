<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "stocks_id",
        "product_types_id",
        "product_name",
        "product_price",
        "product_status",
        "product_img",
        "product_type_name",
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stocks_id');
    }

    public function productType()
    {
        return $this->belongsTo(Product_type::class, 'product_types_id');
    }

    public function roomservices()
    {
        return $this->hasMany(Roomservice::class, 'product_id');
    }
}
