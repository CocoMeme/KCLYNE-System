<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }
}
