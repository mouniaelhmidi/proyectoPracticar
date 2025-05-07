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

class FormController extends Controller
{
    //ESTE CONTROLADOR SE ENCARGA DE MOSTRAR EL FORMULARIO
    public function index(){ 
        return Inertia::render('form', []);
    }
}
