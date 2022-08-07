<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    public function branch() {
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function employee() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function type_absen() {
        return $this->belongsTo(TypeAbsen::class,'type_absen_id');
    }
}
