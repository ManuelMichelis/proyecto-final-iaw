<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Posteo;
use App\Models\Topico;

class PosteoController extends Controller
{
    /**
     * Crea un nuevo posteo para el usuario en sesion, tomando un titulo,
     * contenido y topico tratado
     */
    public function crearPosteo (Request $request)
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


    /**
     * Crea un nuevo comentario para el usuario en sesion, tomando un titulo,
     * contenido y posteo al que refiere
     */
    public function crearComentario (Request $request)
    {
        $idReferido = $request->id;
        if (is_numeric($idReferido))
        {
            $posteoReferido = Posteo::where('id', $idReferido)->first();
            if ($posteoReferido != null)
            {
                // Debo verificar que el contenido no sea vacio
                $posteo = new Posteo;
                $posteo->titulo = null;
                $posteo->contenido = $request->contenido;
                $posteo->referido()->associate($posteoReferido);
                $posteo->usuario()->associate(Auth::user());
                $topicoTratado = Topico::where('id',$posteoReferido->id_topico_asociado)->first();
                $posteo->topico()->associate($topicoTratado);
                $posteo->save();
                return redirect()->back();
            }
        }
    }


    /**
     * Actualiza el 'me gusta' de un posteo con ID dado como argumento
     * para el usuario en sesion
     */
    public function actualizarLike ($id)
    {
        // Asumo que no existe el 'me gusta'. Esto es, debo registrarlo
        $activado = null;
        $switch = null;
        $posteo = Posteo::where('id',$id)->first();
        // Si el posteo existe, procedo
        if ($posteo != null)
        {
            $usuario = Auth::user();
            $likers = $posteo->likers();
            $like = $likers->where('id',$usuario->id)->first();
            $cantidadLikes = $posteo->likes;
            $cantidadDislikes = $posteo->dislikes;
            // Si no existe el 'me gusta', lo registro
            if ($like == null)
            {
                // Si está 'no me gusta', lo quito antes de registrar el 'me gusta'
                $dislike = $posteo->dislikers->where('id',$usuario->id)->first();
                if ($dislike != null)
                {
                    $switch = true;
                    $posteo->dislikers()->detach($usuario);
                    $posteo->dislikes = $cantidadDislikes - 1;
                }
                else 
                {
                    $switch = false;
                }
                $posteo->likes = $cantidadLikes + 1;
                $posteo->likers()->save($usuario);
                $activado = true;
            }
            // Si ya existe el 'me gusta', debo quitarlo
            else {
                $posteo->likes = $cantidadLikes - 1;
                $posteo->likers()->detach($usuario);
                $activado = false;
            }
            $posteo->save();
        }
        $info = [
            "activado" => $activado,
            "switch" => $switch,
            "likes" => $posteo->likes,
            "dislikes" => $posteo->dislikes
        ];
        return response()->json(['status' => 200, 'data' => $info]);
    }


    /**
     * Actualiza el 'me gusta' de un posteo con ID dado como argumento
     * para el usuario en sesion
     */
    public function actualizarDislike ($id)
    {
        // Asumo que no existe el 'me gusta'. Esto es, debo registrarlo
        $activado = null;
        $switch = null;
        $posteo = Posteo::where('id',$id)->first();
        // Si el posteo existe, procedo
        if ($posteo != null)
        {
            $usuario = Auth::user();
            $dislikers = $posteo->dislikers();
            $dislike = $dislikers->where('id',$usuario->id)->first();
            $cantidadDislikes = $posteo->dislikes;
            $cantidadLikes = $posteo->likes;            
            // Si no existe el 'no me gusta', lo registro
            if ($dislike == null)
            {
                // Si está 'me gusta', lo quito antes de registrar el 'no me gusta'
                $like = $posteo->likers->where('id',$usuario->id)->first();
                if ($like != null)
                {
                    $switch = true;
                    $posteo->likers()->detach($usuario);
                    $posteo->likes = $cantidadLikes - 1;
                }
                else
                {
                    $switch = false;
                }
                $posteo->dislikes = $cantidadDislikes + 1;
                $posteo->dislikers()->save($usuario);
                $activado = true;
            }
            // Si ya existe el 'me gusta', debo quitarlo
            else {
                $posteo->dislikes = $cantidadDislikes - 1;
                $posteo->dislikers()->detach($usuario);
                $activado = false;
            }
            $posteo->save();
        }
        $info = [
            "activado" => $activado,
            "switch" => $switch,
            "likes" => $posteo->likes,
            "dislikes" => $posteo->dislikes
        ];
        return response()->json(['status' => 200, 'data' => $info]);
    }


    /**
     * Muestra la discusion de un posteo generado por un usuario particular,
     * incluyendo sus comentarios
     */
    public function ver ($id)
    {
        if (is_numeric($id))
        {
            $posteo = Posteo::where('id', $id)->first();
            // Si el posteo existe, entonces cargo su vista
            if ($posteo != null)
            {
                $comentarios = $posteo->comentarios->sortByDesc('votos');
                return view('discusion-posteo')
                    ->with('posteo', $posteo)
                    ->with('comentarios', $comentarios);
            }
        }
    }


    /**
     * Elimina un posteo con un id en particular, siempre que
     * corresponda a uno del usuario en sesion
     */
    public function eliminar ($id)
    {
        // Revisar que corresponda al del usuario en sesion
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
