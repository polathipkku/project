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
        'pack_qty',
        'items_per_pack',
        'package_type',
        'sumitem',

    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
