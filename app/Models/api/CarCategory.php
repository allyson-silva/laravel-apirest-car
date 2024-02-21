<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'car_category';
    
    protected $fillable = [
        'name',
        'description',
       
    ];
}
