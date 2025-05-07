<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    // Mostrar el formulario principal
    public function index(){
        $movies = Movie::with('genre')->get();
        return Inertia::render('Movies/Index', ['movies' => $movies]);
    }


    // Guardar una nueva película
    public function save(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'genre_id' => 'required|exists:genres,id',
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Película creada correctamente.');
    }

    // Mostrar los detalles de una película
    public function show($id){
        $movie = Movie::with('genre')->findOrFail($id);
        return Inertia::render('Movies/Show', ['movie' => $movie]);
    }

    // Mostrar el formulario para editar una película
    public function edit($id){
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return Inertia::render('Movies/Edit', ['movie' => $movie, 'genres' => $genres]);
    }

    // Actualizar una película
    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Película actualizada correctamente.');
    }

    // Eliminar una película
    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Película eliminada correctamente.');
    }
}