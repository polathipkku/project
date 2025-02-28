<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'expenses_name',
        'expenses_price',
        'expenses_date',
        'type',
        'expenses_note',
    ];
}
