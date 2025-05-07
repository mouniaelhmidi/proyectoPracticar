<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //controlador index
    public function index(){
        //llamar a los modelos 
        $teachers = Teacher::all(); //profes
        $subjects = Subject::all();  //materias
        return Inertia::render('addVista', [ //addProfe es el nombre de la vista 
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }

    //controlador para guardar la materia
    public function save(Request $request){
        //validar los campos 
        $validated = request()->validate([
            'name' => 'required', 
            'description' => 'nullable',
            'teacher_id' => 'nullable',
        ]);
        //llamar al modelo que tambien hay que importarlo arriba 
        $subject= new Subject();
        //llamar aqui tambien todos los campos 
        $subject->name =$validated['name'];
        $subject->description =$validated['description'];
        $subject->teacher_id =$validated['teacher_id'];
        //dd($subject);
        $subject->save();
        //redirigir la vista 
        return redirect()->route('ruta.show', ['id' => $subject->id]);
        
    }

    public function show($id){
        //buscar por id
        $subject = Subject::find($id);
        //llamar al modelo 
        $students = Student::all();
        return Inertia::render('showVista', [
            'subject' => $subject,
            'students' => $students,
        ]);
    }

    public function edit(Request $request){
        //buscar por id la materia 
        $subjects = Subject::findOrFail($request->id);  //materias
        //mostrar todos los profes 
        $teachers = Teacher::all(); //profes
        return Inertia::render('editVista', [ //addProfe es el nombre de la vista 
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }

    public function update(Request $request, $id) {
        // Validar los campos
        $validated = $request->validate([
            'name' => 'required', 
            'description' => 'nullable',
            'teacher_id' => 'nullable',
        ]);
        // Buscar el registro en la base de datos
        $subject = Subject::findOrFail($id);
        // Actualizar los campos
        $subject->name = $validated['name'];
        $subject->description = $validated['description'];
        $subject->teacher_id = $validated['teacher_id'];
        // Guardar los cambios
        $subject->save();
        // Redirigir a la vista deseada
        return redirect()->route('ruta.show', ['id' => $subject->id]);
    } 

    public function destroy($id) {
        // Buscar el registro en la base de datos
        $subject = Subject::findOrFail($id);
        // Eliminar el registro
        $subject->delete();
        // Redirigir a la vista deseada
        return redirect()->route('ruta.index');
    }

    public function list(){
        $subjects = Subject::with('teacher')->get(); // con relaciones si las necesitas
        $teachers = Teacher::all();

        return Inertia::render('Subjects/List', [
            'subjects' => $subjects,
            'teachers' => $teachers, 
        ]);
    }



}
