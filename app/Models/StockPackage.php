<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stock_id',
        'stockproduct_name',
        'pack_qty',
        'items_per_pack',
        'sumitem',
        'package_type',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
