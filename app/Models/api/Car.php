<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'car';
    
    protected $fillable = [
        'car_category_id',
        'name',
       
    ];
}
