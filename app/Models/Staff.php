<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = "staff";
    protected $fillable = ([
        'full_name','photo','email','department_id','salary_type','salary_amount',
    ]);

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
