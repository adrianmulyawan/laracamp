<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampBenefit extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "camp_benefits";

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];
}
