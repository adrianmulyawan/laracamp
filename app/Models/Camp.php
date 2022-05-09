<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'camps';

    protected $fillable = [
        'title', 
        'price'
    ];

    protected $hidden = []; 
}
