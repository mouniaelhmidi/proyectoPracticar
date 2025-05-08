<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
//MODELOS 
use App\Models\Offer;
use App\Models\Category;


class OfferController extends Controller
{
    //INDEX: SOLO MUESTRA LA VISTA
    public function index(){
        //llamar a los modelos 
        $offers = Offer::all(); //ofertas
        $categories = Category::all(); //categorias el seed
        return Inertia::render('vueadd', [ //addProfe es el nombre de la vista 
            'offers' => $offers,
            'categories' => $categories,
        ]);
        // en el web acordar de importar el controlador 
        //RUTA: Route::get('/addoffer', [OfferController::class, 'index'])->name('offer.index');
    }

    //SAVE:GUARDA LA INFO EN LA BDD
    public function save(Request $request){
        //validar los campos 
        $validated = request()->validate([
            'name' => 'required', 
            'description' => 'nullable',
            'category_id' => 'nullable',
        ]);
        //llamar al modelo que tambien hay que importarlo arriba ej: $subject= new Subject();
        $offer = new Offer();
        //llamar aqui tambien todos los campos ej: $subject->name =$validated['name'];
        $offer->name =$validated['name'];
        $offer->description =$validated['description'];
        $offer->category_id =$validated['category_id'];
        //guardar ej: $subject->save();
        $offer->save();
        //redirigir la vista 
        return redirect()->route('offer.show', ['id' => $offer->id]);
        //RUTA: Route::post('/saveoffer', [OfferController::class, 'save'])->name('offer.save');
        //para editar el nombre de las coumnas es: sail artisan migrate:fresh --seed
    }

    //SHOW: MUESTA LA INFO DE UN ELEMENTO
    public function show($id){
        //buscar por id teniendo en cuneta la relacion con la categoria
        $offer = Offer::with('categories')->findOrFail($id); // Cargar la relación con la categoría
        return Inertia::render('vueshow', [  
            'offer' => $offer,
        ]);
        //RUTA: Route::get('/offer/{id}', [OfferController::class, 'show'])->name('offer.show');
    }

    //EDIT: MUESTRA EL FORM DE EDITAR
    public function edit(Request $request){
        //buscar por id la oferta 
        $offer = Offer::findOrFail($request->id);  //ofertas
        //mostrar todas las categorias 
        $categories = Category::all(); //categorias el seed
        return Inertia::render('vueedit', [
            'offer' => $offer,
            'categories' => $categories,
        ]);
        //RUTA: Route::get('/offeredit/{id}', [OfferController::class, 'edit'])->name('offer.edit');
    }

    //UPDATE: ACTUALIZA LA INFO EN LA BDD
    public function update(Request $request, $id) {
        // Validar los campos
        $validated = $request->validate([
            'name' => 'required', 
            'description' => 'nullable',
            'category_id' => 'nullable',
        ]);
        // Buscar el registro en la base de datos
        $offer = Offer::findOrFail($id);
        // Actualizar los campos
        $offer->name = $validated['name'];
        $offer->description = $validated['description'];
        $offer->category_id = $validated['category_id'];
        // Guardar los cambios
        $offer->save();
        // Redirigir a la vista de detalle o listado
        return redirect()->route('offer.show', ['id' => $offer->id]);
        //RUTA: Route::put('/offeredit/{id}', [OfferController::class, 'update'])->name('offer.update');
    }

    //DESTROY: ELIMINA UN ELEMENTO DE LA BDD
    public function destroy($id){
        //buscar por id 
        $offer = Offer::findOrFail($id);
        //eliminar el elemento de la bdd
        $offer->delete();
        //redirigir a la vista deseada
        return redirect()->route('offer.list')->with('success', 'Oferta eliminada correctamente.');
        //RUTA: Route::delete('/offerdelete/{id}', [OfferController::class, 'destroy'])->name('offer.delete');
    }

    //EJEMPLO SOFT DELETE



    //LIST: MUESTRA TODOS LOS ELEMENTOS DE LA BDD
    public function list(){
        $offers = Offer::with('categories')->get(); // con relaciones si las necesitas
        $categories = Category::all();
        return Inertia::render('vuelist', [
            'offers' => $offers,
            'categories' => $categories,
        ]);
        //RUTA: Route::get('/offerlist', [OfferController::class, 'list'])->name('offer.list'); 
    }


}
