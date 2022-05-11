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

    public function camp_benefits()
    {
        return $this->hasMany(CampBenefit::class, 'camp_id', 'id');
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'camp_id', 'id');
    }
}
