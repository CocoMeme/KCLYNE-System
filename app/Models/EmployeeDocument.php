<?php

// EmployeeDocument.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDocument extends Model
{
    use SoftDeletes;
    protected $fillable = ['employee_id', 'document_type', 'file_name'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}



