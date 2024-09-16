<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Roomservice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'roomservic_id',
    ];

    public function roomserviceDetails()
    {
        return $this->hasMany(Roomservice_detail::class, 'roomservic_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
