<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Posteo;
use App\Models\Topico;

class PostController extends Controller
{
    /**
     * Obtiene todos los empleados registrados y lo suministra a una vista para su visualización
     */
    public function create (Request $request)
    {
        $posteo = new Posteo;
        $posteo->titulo = $request->titulo;
        $posteo->contenido = $request->contenido;
        $posteo->id_referido = $request->referido;
        $posteo->usuario()->associate(Auth::user());
        $topicoTratado = Topico::where('nombre',$request->topico)->first();
        $posteo->topico()->associate($topicoTratado);
        $posteo->save();
        return redirect()->to('/dashboard');
    }

    public function updateLike ($id)
    {
        $posteo = Posteo::where('id',$id)->first();
        // Si el posteo existe, procedo
        if ($posteo != null)
        {
            $usuario = Auth::user();
            $votantesPosteo = $posteo->votantes();
            $voto = $votantesPosteo->where('id',$usuario->id)->first();
            $cantidadVotos = $posteo->votos;
            // Si no existe el "me gusta", lo registro
            if ($voto == null)
            {
                $posteo->votos = $cantidadVotos + 1;
                $posteo->votantes()->save($usuario);
            }
            // Si ya existe el me gusta, lo quito
            else {
                $posteo->votos = $cantidadVotos - 1;
                $posteo->votantes()->detach($usuario);
            }
            $posteo->save();
            // Faltaría tener acceso al componente gráfico de la "tarjeta-posteo" para el posteo, y volver a renderizarla.
            return redirect()->back();
        }
        return redirect()->to('/dashboard');
    }

    public function delete ($id)
    {
        $eliminado = false;
        if (is_numeric($id))
        {
            $posteo = Posteo::where('id',$id)->first();
            if ($posteo != null)
            {
                $eliminado = $posteo->delete();
                return redirect()->back();
            }
        }
        return redirect()->to('/dashboard');
    }


}
