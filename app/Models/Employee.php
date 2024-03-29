<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'sex',
        'phone',
        'house_no',
        'street',
        'baranggay',
        'city',
        'province',
        'position',
        'payrate_per_hour',
        'employee_image',
    ];
}
