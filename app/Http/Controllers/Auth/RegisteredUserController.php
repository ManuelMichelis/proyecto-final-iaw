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

        $topico1 = Topico::create([
            'nombre' => 'Computacion'
        ]);
        $topico2 = Topico::create([
            'nombre' => 'Peliculas'
        ]);

        $posteo1 = new Posteo;
        $posteo1->titulo = '¿Hay algo mejor que Python?';
        $posteo1->contenido = '¡Python es el mejor lenguaje de programacion! Hasta ahora no vi otro lenguaje tan fácil de aprender y que se use mucho actualmente';
        $posteo1->votos = 130;

        $posteo2 = new Posteo;
        $posteo2->titulo = 'Duda con la ED pila y Java';
        $posteo2->contenido = '¿Alguien sabe como implementar una pila en Java? No me queda claro cómo realizar la implementación';
        $posteo2->votos = 320;

        $posteo3 = new Posteo;
        $posteo3->titulo = "Final de Once upon a time in Hollywood";
        $posteo3->contenido = 'El final de "Once upon a time in Hollywood" es genial ¿no les parece?';
        $posteo3->votos = 1230;

        // ASOCIO POSTEOS Y TOPICOS

        $posteo1->usuario()->associate($usuario);
        $posteo2->usuario()->associate($usuario);
        $posteo3->usuario()->associate($usuario);

        $posteo1->topico()->associate($topico1);
        $posteo2->topico()->associate($topico1);
        $posteo3->topico()->associate($topico1);

        $posteo1->save();
        $posteo2->save();
        $posteo3->save();

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME);
    }
}
