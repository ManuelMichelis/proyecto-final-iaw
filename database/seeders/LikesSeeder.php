<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Posteo;


class LikesSeeder extends Seeder
{

    const TOTAL_POSTEOS_SEEDING = 80;
    const TOTAL_USUARIOS_SEEDING = 13;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ANDY
        $usuario = User::find(1);
            // Computacion
            $posteo = Posteo::find(44); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(2); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Deportes
            $posteo = Posteo::find(62); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(31); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(48); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
            // Humor
            $posteo = Posteo::find(47); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Mercados
            $posteo = Posteo::find(69); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Noticias
            $posteo = Posteo::find(53); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(10); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();        
        // ANA
        $usuario = User::find(2);
            // Computacion
            $posteo = Posteo::find(12); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Series y películas
            $posteo = Posteo::find(28); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(74); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(71); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
            // Musica
            $posteo = Posteo::find(55); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(36); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Discusion
            $posteo = Posteo::find(17); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
            // Noticias
            $posteo = Posteo::find(53); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(57); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
        
        // ALE
        $usuario = User::find(3);
            // Computacion
            $posteo = Posteo::find(1); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(2); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Series y películas
            $posteo = Posteo::find(28); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(35); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(38); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(74); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Deportes
            $posteo = Posteo::find(6); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(31); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(48); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(68); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
            // Videojuegos
            $posteo = Posteo::find(72); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(46); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(11); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
        // JUAN
        $usuario = User::find(4);
            // Series y películas
            $posteo = Posteo::find(26); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(28); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(35); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(74); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Gastronomía
            $posteo = Posteo::find(33); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(54); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(65); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(59); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();
            // Lectura
            $posteo = Posteo::find(66); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(79); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(42); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Discusion
            $posteo = Posteo::find(52); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(56); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(73); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(78); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            // Humor
            $posteo = Posteo::find(43); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(47); // Like
            $posteo->likes = $posteo->likes + 1;
            $posteo->likers()->save($usuario);
            $posteo->save();
            $posteo = Posteo::find(23); // DISLIKE
            $posteo->dislikes = $posteo->dislikes + 1;
            $posteo->dislikers()->save($usuario);
            $posteo->save();

        
        // GENERACIÓN ALEATORIA DE LIKES Y DISLIKES PARA USUARIOS DE ID 5 A 13
        $id = 5;
        for ($id; $id < self::TOTAL_USUARIOS_SEEDING; $id++)
        {
            $usuario = User::find($id);
            $cant_asignada = random_int(1,28);
            $index = 0;
            for ($index; $index < $cant_asignada; $index++)
            {
                $codigo_accion = random_int(0,self::TOTAL_POSTEOS_SEEDING);
                $id_posteo_tomado = random_int(1,self::TOTAL_POSTEOS_SEEDING);
                $posteo = Posteo::find($id_posteo_tomado);
                // Si no está entre los gustados o no gustados, sigo
                if (!$posteo->estaInteresado($usuario) && !$posteo->estaDesinteresado($usuario))
                {
                    // Si es múltiplo de 5, va DISLIKE; Si no, va LIKE
                    if ($codigo_accion % 5 == 0)
                    {
                        $posteo->dislikers()->save($usuario);
                        $posteo->dislikes += 1;     
                    }
                    else
                    {
                        $posteo->likers()->save($usuario);
                        $posteo->likes += 1;
                    }
                    $posteo->save();
                }
            }
        }
        

    }
}
