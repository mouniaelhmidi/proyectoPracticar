<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
//importar modelos


class GuiaController extends Controller
{ 
    //READ: controlador para que solo muestre la vista de la pagina 
    public function index(){
        //passar todos los modelos 
        return Inertia::render('home', [
        ]);
        //RUTA: Route::get('/modelos', [GuiaController::class, 'index'])->name('modelo.index');
    }

    //CREATE: controlador para guardar la informacion en la bdd 
    public function save(Request $request){
        //validar los campos 
        $validated = request()->validated([
            'campo1' => 'required', 
            //añadir los campos que hay
        ]);
        //llamar al modelo que tambien hay que importarlo arriba 
        $modelo= new Modelo();
        //llamar aqui tambien todos los campos 
        $modelo->campo1 =$validated['campo1'];
        $modelo->save();
        //redirigir la vista 
        return redirect()->route('rutapara.connectarconvista', ['id' => $modelo->id]);
        //RUTA: Route::post('/modelo', [GuiaController::class, 'save'])->name('modelo.save');
    }

    //READ: controlador que muestra la informacion desde la bdd
    public function show($id){
        // Buscar el registro en la base de datos
        $modelo = Modelo::findOrFail($id);
        // Retornar la vista o respuesta con los datos
        return Inertia::render('VistaMostrar', 
            ['modelo' => $modelo,
        ]);
        //RUTA: Route::get('/modelo/{id}', [GuiaController::class, 'show'])->name('modelo.show');
    }

    //READ: Mostrar el formulario de editar 
    public function edit(Request $request){
        //passar todos los modelos 
        $modelo = Modelo::findOrFail($request->id);
        // Pasar el modelo a la vista de edición
         return Inertia::render('VistaEditar', [
            'modelo' => $modelo,
        ]);
        //RUTA: Route::get('/modelo/{id}/edit', [GuiaController::class, 'edit'])->name('modelo.edit');
    }

    //UPDATE: contrlador de editar
    public function update(Request $request, $id) {
        // Validar los campos
        $validated = $request->validate([
            'campo1' => 'required',
            // Añadir los demás campos...
        ]);
        // Buscar el registro en la base de datos
        $modelo = Modelo::findOrFail($id);
        // Actualizar los datos y guardar
        $modelo->update($validated);
        // Redirigir a la vista de detalle o listado
        return redirect()->route('modelo.show', ['id' => $modelo->id]);
        //RUTA: Route::put('/modelo/{id}', [GuiaController::class, 'update'])->name('modelo.update');
    }

    //DELETE: coontrolador para hecer el SOFT DELETE 
    public function delete(Request $request){
        //buscar por id 
        $modelo = Modelo::findOrFail($request->id);
        //hacer soft delte 
        $modelo->deleted = true;
        $modelo->deleted_at = now();
        //guardar 
        $modelo->save();
        //redirigir 
        return to_route('nombre.nuta');
        //RUTA: Route::delete('/modelo/{id}', [GuiaController::class, 'delete'])->name('modelo.delete');
    }

    //DELETE: controlador para eliminar por completo 
    public function destroy(Request $request){
        // Buscar el registro en la base de datos
        $modelo = Modelo::findOrFail($id);
        // Eliminar permanentemente
        $modelo->delete(); 
        // Redirigir a la vista de listado con mensaje de éxito
        return redirect()->route('modelo.index')->with('success', 'Registro eliminado correctamente');
        //RUTA: Route::delete('/modelo/{id}', [GuiaController::class, 'destroy'])->name('modelo.delete');
    }
    
    //controlador para hacer una lista 

}
