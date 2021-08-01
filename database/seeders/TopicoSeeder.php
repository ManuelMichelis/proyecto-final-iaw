<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Topico;

class TopicoSeeder extends Seeder
{
    /**
     * Creación de los tópicos admitidos por la aplicación
     */
    public function run()
    {
        // COMPUTACIÓN
        $topico = new Topico();
        $topico->nombre = 'Computación';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-computacion.png'));
        $topico->save();

        // SERIES Y PELÍCULAS
        $topico = new Topico();
        $topico->nombre = 'Series y películas';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-peliculas.png'));
        $topico->save();

        // MÚSICA
        $topico = new Topico();
        $topico->nombre = 'Música';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-musica.png'));
        $topico->save();

        // VIDEOJUEGOS
        $topico = new Topico();
        $topico->nombre = 'Videojuegos';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-videojuegos.png'));
        $topico->save();

        // COCINA
        $topico = new Topico();
        $topico->nombre = 'Gastronomía';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-cocina.png'));
        $topico->save();

        // LIBROS
        $topico = new Topico();
        $topico->nombre = 'Libros';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-libros.png'));
        $topico->save();

        // HISTORIA
        $topico = new Topico();
        $topico->nombre = 'Historia';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-historia.png'));
        $topico->save();

        // DEPORTES
        $topico = new Topico();
        $topico->nombre = 'Deportes';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-deportes.png'));
        $topico->save();

        // HUMOR
        $topico = new Topico();
        $topico->nombre = 'Humor';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-humor.png'));
        $topico->save();

        // POLÍTICA
        $topico = new Topico();
        $topico->nombre = 'Política';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-politica.png'));
        $topico->save();

        // ECONOMÍA Y MERCADOS
        $topico = new Topico();
        $topico->nombre = 'Dinero y mercados';
        $topico->icono = base64_encode(file_get_contents(public_path().'\icons\top-economia.png'));
        $topico->save();

    }
}
