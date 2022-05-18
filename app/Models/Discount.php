<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'discounts';

    protected $fillable = [
        'name', 
        'code', 
        'description',
        'percentage'
    ];

    protected $hidden = [];
}
