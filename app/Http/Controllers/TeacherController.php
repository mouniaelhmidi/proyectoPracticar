<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Courses;
use App\Models\Student;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TeacherController extends Controller
{
    //controlador index
    public function index(){
        $teachers = Teacher::all(); //profes
        //$sutdents = Auth::user()->students; //estudiante
        //$students = Student::all();
        //$courses = Courses::all(); //cursos
        //$subjects = Subject::all();  //materias

        return Inertia::render('addProfe', [ //addProfe es el nombre de la vista 
            'teachers' => $teachers,
            //'students' => $sutdents,
            //'courses' => $courses,
            //'subjects' => $subjects,
        ]);
    }

    //controlador save

    public function save(Request $request) {
        $validated = request()->validate([


        ]);

        $teacher = Teacher::all();
        


    }



}

