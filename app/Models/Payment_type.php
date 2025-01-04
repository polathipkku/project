<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment_type extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'payment_type',
        'qr_code',
    ];
    
    public function payment()
    {
        return $this->hasMany(Payment::class, 'payment_type_id');
    }
}