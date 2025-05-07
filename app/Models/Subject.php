<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'teacher_id',
    ];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    //tienen una tabla pivote que es student_subject 
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }
}
