<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posteo;
use App\Models\User;
use App\Models\Topico;

class PosteoSeeder extends Seeder
{
    const COMPUTACION = 1;
    const SERIES_Y_PELICULAS = 2;
    const MUSICA = 3;
    const VIDEOJUEGOS = 4;
    const GASTRONOMIA = 5;
    const LECTURA = 6;
    const DISCUSION = 7;
    const DEPORTES = 8;
    const HUMOR = 9;
    const POLITICA = 10;
    const MERCADOS = 11;
    const NOTICIAS = 12;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Posteo 1
        $posteo = new Posteo();
        $posteo->titulo = '¿Hay algo mejor que Python?';
        $posteo->contenido = '¡Python es el mejor lenguaje de programacion! Hasta ahora no vi otro lenguaje tan fácil de aprender y que se use mucho actualmente';
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::COMPUTACION));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 2
        $posteo = new Posteo();
        $posteo->titulo = 'Duda con la ED pila y Java';
        $posteo->contenido = '¿Alguien sabe como implementar una pila en Java? No me queda claro cómo realizar la implementación';
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::COMPUTACION));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 3
        $posteo = new Posteo();
        $posteo->titulo = "Final de Once upon a time in Hollywood";;
        $posteo->contenido = 'El final de "Once upon a time in Hollywood" es genial ¿no les parece?';;
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 4
        $posteo = new Posteo();
        $posteo->titulo = "Próximo Presidente";
        $posteo->contenido = '¿Quién creen que tiene más chances de ser Presidente para el 2023? Tengo más dudas que certezas...';
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();        

        // Posteo 6
        $posteo = new Posteo();
        $posteo->titulo = "Mi reflexión sobre la falta de democracia";
        $posteo->contenido = "La Mejor demostración de que no vivimos mas en una democracia participativa es el apoyo de la gente, a que los Intendentes puedan ser elejidos de manera indefinida";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));        
        $posteo->save();

        // Posteo 7
        $posteo = new Posteo();
        $posteo->titulo = "¿Cómo debería formar la selección argentina vs Brasil?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(4)); // Juan
        $posteo->save();

        // Posteo 8
        $posteo = new Posteo();
        $posteo->titulo = "¡5 Seconds of Summer lanza su nueva canción! Se llama 2011";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 9
        $posteo = new Posteo();
        $posteo->titulo = "Todo lo que debes saber sobre el eclipse total de sol de este sábado";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 10
        $posteo = new Posteo();
        $posteo->titulo = "¿Cómo afectará Ómicron a los Mercados y a la recuperación económica?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MERCADOS));
        $posteo->usuario()->associate(User::find(10)); // Julian
        $posteo->save();

        // Posteo 11
        $posteo = new Posteo();
        $posteo->titulo = "Xiomara Castro consolida su ventaja para convertirse en la próxima presidenta de Honduras";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 12
        $posteo = new Posteo();
        $posteo->titulo = "Me encanta el nuevo capitulo de Fortnite";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::VIDEOJUEGOS));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 13
        $posteo = new Posteo();
        $posteo->titulo = "Lugares de Argentina según una Inteligencia Artifical (Wombo Dream)";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::COMPUTACION));
        $posteo->usuario()->associate(User::find(3)); // Ale
        $posteo->save();

        // Posteo 14
        $posteo = new Posteo();
        $posteo->titulo = "¡Les traigo la mejor receta de torta de mandarina del mundo!";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(4)); // Juan
        $posteo->save();

        // Posteo 15
        $posteo = new Posteo();
        $posteo->titulo = "¿Qué está pasando con la gente, que es cada día más propensa a volcarse a lo irracional?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 16
        $posteo = new Posteo();
        $posteo->titulo = "¿Qué lugares hay para comprar ropa buena en Bahía? Que no sea caro, eh...";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(10)); // Julian
        $posteo->save();

        // Posteo 17
        $posteo = new Posteo();
        $posteo->titulo = "Mejores lugares para hacer Crossfit en Bahía";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 18
        $posteo = new Posteo();
        $posteo->titulo = "Me mudo a Bahía Blanca con mi pareja ¿Cuáles barrios NO debería considerar?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 19
        $posteo = new Posteo();
        $posteo->titulo = "¿Qué variedades de pizza preparan en sus casas? Necesito ideas nuevas";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(4)); // Juan
        $posteo->save();

        // Posteo 20
        $posteo = new Posteo();
        $posteo->titulo = "Rumores de que Vanilla Fudge viene a tocar a Argentina este año ";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(5)); // Eric
        $posteo->save();

        // Posteo 21
        $posteo = new Posteo();
        $posteo->titulo = "¿Podría el Sol ser una fuente desconocida del agua de la Tierra?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 22
        $posteo = new Posteo();
        $posteo->titulo = "¿Lewis Hamilton podrá ganar el Gran Premio de Arabia Saudita?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(10)); // Julian
        $posteo->save();

        // Posteo 23
        $posteo = new Posteo();
        $posteo->titulo = "Murió el segundo ladrón baleado por el joyero en Florencio Varela";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(5)); // Eric
        $posteo->save();

        // Posteo 24
        $posteo = new Posteo();
        $posteo->titulo = "Cuando en Smallville pusieron que las Cataratas del Iguazú estaban en la Patagonia";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::HUMOR));
        $posteo->usuario()->associate(User::find(3)); // Ale
        $posteo->save();

        // Posteo 25
        $posteo = new Posteo();
        $posteo->titulo = "Diganme que es joda que Presidencia gasta 200000$ por mes en taxis y remises";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();

        // Posteo 26
        $posteo = new Posteo();
        $posteo->titulo = "¿Que fines u objetivos tienen para los cuales deben gastar dinero?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 27
        $posteo = new Posteo();
        $posteo->titulo = "¿Breaking Bad les parece la mejor serie/show de la historia? A mi sí";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 28
        $posteo = new Posteo();
        $posteo->titulo = "Usuarios de MercadoLibre y MercadoPago podrán comprar/guardar/vender crypto";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MERCADOS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 29
        $posteo = new Posteo();
        $posteo->titulo = "Estreno de la 5ta temporada de BETTER CALL SAUL";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(5)); // Eric
        $posteo->save();

        // Posteo 30
        $posteo = new Posteo();
        $posteo->titulo = "El grupo peruano dueño de Zorro, Plusbelle y Okebon vende sus operaciones en el país";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MERCADOS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 31
        $posteo = new Posteo();
        $posteo->titulo = "Varios muertos por la erupción del volcán Semeru en Indonesia";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 32
        $posteo = new Posteo();
        $posteo->titulo = "¡CHACO ES FOR EVER Y FOR EVER DE PRIMERA NACIONAL!";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(10)); // Julian
        $posteo->save();

        // Posteo 33
        $posteo = new Posteo();
        $posteo->titulo = "30 puntos los Seahawks en el 3er cuarto. Ni los más viejos recuerdan algo así...";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();

        // Posteo 34
        $posteo = new Posteo();
        $posteo->titulo = "El arranque de Masterchef Celebrity fue un embole";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(6)); // Tina
        $posteo->save();

        // Posteo 35
        $posteo = new Posteo();
        $posteo->titulo = "ARA San Juan: Procesan a los sospechosos de realizar espionaje";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();

        // Posteo 36
        $posteo = new Posteo();
        $posteo->titulo = "Tremenda la serie Unsolved, sobre los asesinatos de Tupac y Biggie Smalls";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 37
        $posteo = new Posteo();
        $posteo->titulo = "Keep me hangin' on, el mejor tema de Rock que escuché en mi vida";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(5)); // Eric
        $posteo->save();

        // Posteo 38
        $posteo = new Posteo();
        $posteo->titulo = "La policía arresta a un hombre armado frente al edificio de la ONU en Nueva York";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 39
        $posteo = new Posteo();
        $posteo->titulo = "¿Opiniones sobre le serie de Maradona? ¿Vale la pena?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(10)); // Julian
        $posteo->save();

        // Posteo 40
        $posteo = new Posteo();
        $posteo->titulo = "Todos los libros de Mario Puzo sobre Mafia";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::LECTURA));
        $posteo->usuario()->associate(User::find(6)); // Tina
        $posteo->save();

        // Posteo 41
        $posteo = new Posteo();
        $posteo->titulo = "Histórico mal desempeño de Argentina en una evaluación de aprendizaje de la Unesco";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 42
        $posteo = new Posteo();
        $posteo->titulo = "¿Que hacen cuando sienten que estan en la lona?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 43
        $posteo = new Posteo();
        $posteo->titulo = "Libros que inspiraron grandes películas";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::LECTURA));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 44
        $posteo = new Posteo();
        $posteo->titulo = "¡¡Funciones de Moldavsky en el Teatro Don Bosco a fin de año!!";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::HUMOR));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 45
        $posteo = new Posteo();
        $posteo->titulo = "Algoritmos de aprendizaje supervisado para trabajar en sistemas de recomendación";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::COMPUTACION));
        $posteo->usuario()->associate(User::find(1)); // Ale
        $posteo->save();

        // Posteo 46
        $posteo = new Posteo();
        $posteo->titulo = "El Tribunal de Myanmar condena a Aung San Suu Kyi a cuatro años de prisión";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 47
        $posteo = new Posteo();
        $posteo->titulo = "GTA Trilogy ¿Es algo que vale la pena o es una enorme estafa?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::VIDEOJUEGOS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 48
        $posteo = new Posteo();
        $posteo->titulo = "Compilado de monólogos de Baby Etchecopar para llorar de risa";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::HUMOR));
        $posteo->usuario()->associate(User::find(1)); // Lucas
        $posteo->save();

        // Posteo 49
        $posteo = new Posteo();
        $posteo->titulo = "Otro balón de oro para Messi ¿No les parece que este premio perdió la gracia?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 50
        $posteo = new Posteo();
        $posteo->titulo = "Cae la soja y el maíz por una noticia de China";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MERCADOS));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 51
        $posteo = new Posteo();
        $posteo->titulo = "División radical: diputados que responden a Lousteau arman bancada aparte";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();

        // Posteo 52
        $posteo = new Posteo();
        $posteo->titulo = "¿Tiene chances Liverpool de volver a ganar una Champions con Klopp?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(3)); // Ale
        $posteo->save();

        // Posteo 53
        $posteo = new Posteo();
        $posteo->titulo = "Las golosinas más ricas de los 90 que ya no existen";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 54
        $posteo = new Posteo();
        $posteo->titulo = "Eligieron el mejor bife del mundo y es de la Argentina";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(7)); // Dani
        $posteo->save();

        // Posteo 55
        $posteo = new Posteo();
        $posteo->titulo = "¿Alguno tiene la receta original de los cannoli sicilianos?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(8)); // Leo
        $posteo->save();

        // Posteo 56
        $posteo = new Posteo();
        $posteo->titulo = "Éxitos musicales de los años 70 y 80";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 57
        $posteo = new Posteo();
        $posteo->titulo = "¿Cuál es el regalo que les gustaría recibir para esta Navidad?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 58
        $posteo = new Posteo();
        $posteo->titulo = "A partir del 21 de diciembre, PBA pondrá en marcha el pase sanitario";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 59
        $posteo = new Posteo();
        $posteo->titulo = "La selección ya tiene un lugar en el Mundial de Qatar 2022";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(3)); // Ale
        $posteo->save();

        // Posteo 60
        $posteo = new Posteo();
        $posteo->titulo = "Turrón casero de maní con crema catalana";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 61
        $posteo = new Posteo();
        $posteo->titulo = "Biggie vs Tupac ¿Cuál fue el mejor de los dos?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(3)); // Ale
        $posteo->save();

        // Posteo 62
        $posteo = new Posteo();
        $posteo->titulo = "El rapero Lil Wayne está investigado por apuntar con un arma a un policía";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 63
        $posteo = new Posteo();
        $posteo->titulo = "¿Qué piensan del presente de Messi en el PSG? ¿Volverá al Barcelona?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(4)); // Juan
        $posteo->save();

        // Posteo 64
        $posteo = new Posteo();
        $posteo->titulo = "¡No me canso de escuchar la música de James Brown!";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 65
        $posteo = new Posteo();
        $posteo->titulo = "L.A. NOIRE es una obra maestra. Historia, escenario, música. Todo perfecto";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::VIDEOJUEGOS));
        $posteo->usuario()->associate(User::find(1)); // Andy
        $posteo->save();

        // Posteo 66
        $posteo = new Posteo();
        $posteo->titulo = "Exquisita receta para preparar budín de pan";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::GASTRONOMIA));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 67
        $posteo = new Posteo();
        $posteo->titulo = "El último Don, de Mario Puzo ¿Es tan bueno como el libro de El Padrino?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::LECTURA));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 68
        $posteo = new Posteo();
        $posteo->titulo = "Detectan la primer variante Omicrón en Argentina";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 69
        $posteo = new Posteo();
        $posteo->titulo = "Esteban Rolón tiene ofertas para jugar en el fútbol mexicano";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DEPORTES));
        $posteo->usuario()->associate(User::find(4)); // Juan
        $posteo->save();

        // Posteo 70
        $posteo = new Posteo();
        $posteo->titulo = "Aún no se pudo recuperar 25% de los empleos perdidos durante la cuarentena";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MERCADOS));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 71
        $posteo = new Posteo();
        $posteo->titulo = "Recopilación de samples usados en temas de rap de los 90s";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::MUSICA));
        $posteo->usuario()->associate(User::find(12)); // Pedro
        $posteo->save();

        // Posteo 72
        $posteo = new Posteo();
        $posteo->titulo = "¿Qué les pareció la serie Miami Vice? Se que es vieja, pero la temática está genial";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(6)); // Tina
        $posteo->save();

        // Posteo 73
        $posteo = new Posteo();
        $posteo->titulo = "Comprar juegos en Steam usando cuentas secundarias";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::VIDEOJUEGOS));
        $posteo->usuario()->associate(User::find(9)); // Lucas
        $posteo->save();

        // Posteo 74
        $posteo = new Posteo();
        $posteo->titulo = "Election recall: ¿es una opción viable en Argentina?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(8)); // Leo
        $posteo->save();

        // Posteo 75
        $posteo = new Posteo();
        $posteo->titulo = "En búsqueda de nuevas series o películas para ver ¡Leo sus recomendaciones!";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::SERIES_Y_PELICULAS));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 76
        $posteo = new Posteo();
        $posteo->titulo = "El Gobierno argentino autorizó el uso de la vacuna monodosis Sputnik Light";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::NOTICIAS));
        $posteo->usuario()->associate(User::find(11)); // Julieta
        $posteo->save();

        // Posteo 77
        $posteo = new Posteo();
        $posteo->titulo = "Ranking de gobernadores: los 9 con peor imagen en sus provincias";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::POLITICA));
        $posteo->usuario()->associate(User::find(1));
        $posteo->save();

        // Posteo 78
        $posteo = new Posteo();
        $posteo->titulo = "Voy a visitar a mi familia por navidad: ¿consejos de la aduana en Ezeiza?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(8)); // Leo
        $posteo->save();

        // Posteo 79
        $posteo = new Posteo();
        $posteo->titulo = "¿El viaje más entretenido que hayan hecho en su vida?";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::DISCUSION));
        $posteo->usuario()->associate(User::find(2)); // Ana
        $posteo->save();

        // Posteo 80
        $posteo = new Posteo();
        $posteo->titulo = "Colección de libros de la Segunda Guerra Mundial";
        $posteo->contenido = "";
        $posteo->likes = 0;
        $posteo->topico()->associate(Topico::find(self::LECTURA));
        $posteo->usuario()->associate(User::find(6)); // Tina
        $posteo->save();

        /*
        // Posteo 81
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 82
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 83
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 84
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 85
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 86
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 87
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 88
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 89
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 90
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 91
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 92
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 93
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 94
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 95
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 96
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 97
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 98
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 99
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;

        // Posteo 100
        $posteo = new Posteo();
        $posteo->titulo = "";
        $posteo->contenido = "";
        $posteo->likes = 0;
        */
    }
}
