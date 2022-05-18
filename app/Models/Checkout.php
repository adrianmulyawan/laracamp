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
        'user_id', 
        'camp_id',
        'discount_id',
        'discount_percentage',
        'total',
        'payment_status',
        'midtrans_url', 
        'midtrans_booking_code'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class, 'camp_id', 'id');
    }

    public function setExpiredAttribute($value)
    {
        $this->attributes['expired'] = date('Y-m-t', strtotime($value));

    }
}
