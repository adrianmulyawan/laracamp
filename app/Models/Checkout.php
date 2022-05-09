<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "checkouts";

    protected $fillable = [
        'user_id', 'camp_id', 'card_number', 
        'expired', 'cvc', 'is_paid',
    ];

    protected $hidden = [];
}
