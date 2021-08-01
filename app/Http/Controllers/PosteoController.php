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
     *
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

    private function nuevo (Request $request)
    {

    }




    /**
     * Actualiza el 'gustado' de un posteo con ID dado como argumento
     * para el usuario en sesion
     */
    public function actualizarMG ($id)
    {
        // Asumo que no existe el 'me gusta'. Esto es, debo registrarlo
        $estado = null;
        $posteo = Posteo::where('id',$id)->first();
        // Si el posteo existe, procedo
        if ($posteo != null)
        {
            $usuario = Auth::user();
            $votantesPosteo = $posteo->votantes();
            $gustado = $votantesPosteo->where('id',$usuario->id)->first();
            $cantidadGustados = $posteo->votos;
            // Si no existe el 'me gusta', lo registro
            if ($gustado == null)
            {
                $posteo->votos = $cantidadGustados + 1;
                $posteo->votantes()->save($usuario);
                $estado = true;
            }
            // Si ya existe el me gusta, lo quito
            else {
                $posteo->votos = $cantidadGustados - 1;
                $posteo->votantes()->detach($usuario);
                $estado = false;
            }
            $posteo->save();
        }
        return response()->json(['status' => 200, 'data' => ['gustado' => $estado, 'votos' => $posteo->votos]]);
    }


    public function ver ($id)
    {
        if (is_numeric($id))
        {
            $posteo = Posteo::where('id', $id)->first();
            // Si el posteo existe, entonces cargo su vista
            if ($posteo != null)
            {
                $comentarios = $posteo->comentarios->sortByDesc('votos');
                return view('posteo')
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
