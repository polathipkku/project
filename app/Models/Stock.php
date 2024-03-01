<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "stock_qty",
        "update_by",
        "update_qty"
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'stocks_id');
    }
}
