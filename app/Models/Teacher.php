<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = ['personnale_id','level_id', 'grade_id', 'group_id', 'funcion', 'ingreso_seg', 'ingreso_ct', 'directivo', 'sort'];



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
