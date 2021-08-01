<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topico;
use App\Models\Posteo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $usuario = User::create([
            'alias' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $usuario->save();


        $posteo1 = new Posteo;
        $posteo1->titulo = '¿Hay algo mejor que Python?';
        $posteo1->contenido = '¡Python es el mejor lenguaje de programacion! Hasta ahora no vi otro lenguaje tan fácil de aprender y que se use mucho actualmente';
        $posteo1->votos = 0;

        $posteo2 = new Posteo;
        $posteo2->titulo = 'Duda con la ED pila y Java';
        $posteo2->contenido = '¿Alguien sabe como implementar una pila en Java? No me queda claro cómo realizar la implementación';
        $posteo2->votos = 0;

        $posteo3 = new Posteo;
        $posteo3->titulo = "Final de Once upon a time in Hollywood";
        $posteo3->contenido = 'El final de "Once upon a time in Hollywood" es genial ¿no les parece?';
        $posteo3->votos = 0;

        $posteo4 = new Posteo;
        $posteo4->titulo = "Próximo Presidente";
        $posteo4->contenido = '¿Quién creen que tiene más chances de ser Presidente para el 2023? Tengo más dudas que certezas...';
        $posteo4->votos = 0;

        $posteo5 = new Posteo;
        $posteo5->titulo = "¿Se arriesgarían a comprar bitcoin?";
        $posteo5->contenido = 'Con lo volátil que es el bitcoin, no me termino de dar cuenta si conviene comprar o no. Como sube, cae. Denme sus opiniones';
        $posteo5->votos = 0;

        // ASOCIO POSTEOS Y TOPICOS

        $tComputacion = Topico::where('nombre', 'Computación')->first();
        $tSeriesPeliculas = Topico::where('nombre', 'Series y películas')->first();
        $tPolitica = Topico::where('nombre', 'Política')->first();
        $tEconomiaMercados = Topico::where('nombre', 'Dinero y mercados')->first();

        $posteo1->usuario()->associate($usuario);
        $posteo2->usuario()->associate($usuario);
        $posteo3->usuario()->associate($usuario);
        $posteo4->usuario()->associate($usuario);
        $posteo5->usuario()->associate($usuario);

        $posteo1->topico()->associate($tComputacion);
        $posteo2->topico()->associate($tComputacion);
        $posteo3->topico()->associate($tSeriesPeliculas);
        $posteo4->topico()->associate($tPolitica);
        $posteo5->topico()->associate($tEconomiaMercados);

        $posteo1->save();
        $posteo2->save();
        $posteo3->save();
        $posteo4->save();
        $posteo5->save();

        $usuario->suscripciones()->save($tComputacion);
        $usuario->suscripciones()->save($tSeriesPeliculas);

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME);
    }
}
