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

        $us2 = User::create([
            'alias' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make($request->password),
        ]);

        $us3 = User::create([
            'alias' => 'User 3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make($request->password),
        ]);

        $us4 = User::create([
            'alias' => 'User 4',
            'email' => 'user4@gmail.com',
            'password' => Hash::make($request->password),
        ]);


        $usuario->seguidores()->save($us2);
        $usuario->seguidos()->save($us3);

        $topico1 = Topico::create([
            'nombre' => 'Computacion'
        ]);
        $topico2 = Topico::create([
            'nombre' => 'Peliculas'
        ]);

        $posteo1 = Posteo::create([
            'contenido' => '¡Python es el mejor lenguaje de programacion!',
            'votos' => 100,
            'alias_usuario' => $request->name,
        ]);
        $posteo2 = Posteo::create([
            'contenido' => '¿Alguien sabe como implementar una pila en Java?',
            'votos' => 5,
            'alias_usuario' => $request->name,
        ]);
        $posteo3 = Posteo::create([
            'contenido' => 'El final de "Once upon a time in Hollywood" es genial ¿no les parece?',
            'votos' => 3149,
            'alias_usuario' => $request->name,
        ]);

        // ASOCIO POSTEOS Y TOPICOS

        $posteo1->topicos()->save($topico1);
        $posteo2->topicos()->save($topico1);
        $posteo3->topicos()->save($topico2);

        $posteo1->refresh();

        // GUARDO SUSCRIPCIONES DE USUARIOS A TOPICOS
        DB::insert('insert into suscripciones (alias_usuario, id_topico) values (?, ?)', ['User 1', 1]);
        DB::insert('insert into suscripciones (alias_usuario, id_topico) values (?, ?)', ['User 1', 2]);
        //$usuario->topicos()->save($topico1);
        //$usuario->topicos()->save($topico2);
        /////////////////////////////////////////////
        /*
        $posteoUno = $topico1->exposiciones()->where('id_posteo',1)->get();
        error_log("\$topico1->exposiciones()->where('id_posteo',1)".$posteoUno);
        */

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME);
    }
}
