<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Book; // Importar el modelo Book

class BookController extends Controller
{
    
    //ESTE CONTROLADOR PARA MOSTRAR EL FORMULARIO
    public function index(){ 
        return Inertia::render('form', []);
    }

    //CREATE: controlador para guardar la informacion en la bdd 
    public function save(Request $request){
        //validar los campos 
        $validated = request()->validate([
            'title' => 'required', 
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',

        ]);
        //llamar al modelo que tambien hay que importarlo arriba 
        $book= new Book();
        //llamar aqui tambien todos los campos 
        $book->title =$validated['title'];
        $book->author =$validated['author'];
        $book->publisher =$validated['publisher'];
        $book->genre =$validated['genre'];
        $book->save();
        
        //redirigir la vista 
        return redirect()->route('book.show', ['id' => $book->id]);
        //return redirect()->route('offer.show', ['id' => $offer->id]);
    }

    //READ: controlador que muestra la informacion desde la bdd
    public function show($id){
        // Buscar el registro en la base de datos
        $book = Book::findOrFail($id);
        // Retornar la vista o respuesta con los datos
        return Inertia::render('show', 
            ['book' => $book,
        ]);
        //RUTA: Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
    }

    //READ: Mostrar el formulario de editar 
    public function edit(Request $request){
        //passar todos los modelos 
        $book = Book::findOrFail($request->id);
        // Pasar el modelo a la vista de edición
         return Inertia::render('edit', [
            'book' => $book,
        ]);
        //RUTA: Route::get('/bookedit/{id}', [BookController::class, 'edit'])->name('book.edit');
    }

    //UPDATE: contrlador de editar
    public function update(Request $request, $id) {
        // Validar los campos
        $validated = $request->validate([
            'title' => 'required', 
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',
            // Añadir los demás campos...
        ]);
        // Buscar el registro en la base de datos
        $book = Book::findOrFail($id);
        // Actualizar los datos y guardar
        $book->update($validated);
        // Redirigir a la vista de detalle o listado
        return redirect()->route('book.show', ['id' => $book->id]);
        //RUTA: Route::put('/bookedit/{id}', [BookController::class, 'update'])->name('book.update');
    }

    //DELETE: controlador para eliminar el registro
    public function destroy( $id){
        // Buscar el registro en la base de datos
        $book = Book::findOrFail($id);
        // Eliminar permanentemente
        $book->delete(); 
        // Redirigir a la vista de listado con mensaje de éxito
        return redirect()->route('form.index')->with('success', 'Registro eliminado correctamente');
        //RUTA: Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.delete');
    }

}
