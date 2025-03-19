<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ObservedBy(\App\Observers\TeacherObserver::class)]
class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = ['personnel_id','level_id', 'grade_id', 'group_id', 'funcion', 'ingreso_seg', 'ingreso_ct', 'director', 'extra', 'sort'];



    public function personnel(){
        return $this->belongsTo(Personnel::class);
    }


    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }




}
