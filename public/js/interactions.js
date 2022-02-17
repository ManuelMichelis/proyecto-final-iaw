
const CLASE_NEUTRO = "neutro";
const CLASE_LIKE = "like";
const CLASE_DISLIKE = "dislike";


/**
 * Realiza una solicitud via AJAX al servidor para actualizar el registro
 * del "me gusta" sobre el posteo con id dado como argumento.
 */
function actualizarLike (id, csrfToken, route)
{
    // Preparo y realizo la solicitud HTTP via AJAX
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': csrfToken,
        },
        method: 'POST',
        url: route,
        data:
        {
            'id': id,
        },
        success: function(response)
        {
            // Recupero el componente asociado al boton
            let skinBtn = document.getElementById('btn-like-skin-' + id);
            let componenteLike = document.getElementById('likes_posteo_' + id);
            let likeActivado = response.data.activado;
            let huboSwitch = response.data.switch;
            let claseVieja;
            let claseNueva;
            // Determino la clase CSS a eliminar y por agregar, ademas de actualizar los 'me gusta'
            if (likeActivado)
            {
                claseVieja = CLASE_NEUTRO;
                claseNueva = CLASE_LIKE;
                componenteLike.innerHTML = '<b>' + response.data.likes + ' me gusta </b>';
            }
            else
            {
                claseVieja = CLASE_LIKE;
                claseNueva = CLASE_NEUTRO;
                componenteLike.innerHTML = response.data.likes + ' me gusta';
            }
            if (huboSwitch)
            {
                neutralizarBtnDislike(id,response.data.dislikes);
            }
            // Elimino la clase CSS vieja e incorporo la nueva, modificando el color del boton
            skinBtn.classList.remove(claseVieja);
            skinBtn.classList.add(claseNueva);


        },
        error: function (response) {
            console.log('¡ERROR AL ACTUALIZAR para posteo ' + id + '!');
        }
    });
}


/**
 * Realiza una solicitud via AJAX al servidor para actualizar el registro
 * del "no me gusta" sobre el posteo con id dado como argumento.
 */
 function actualizarDislike (id, csrfToken, route)
 {
     // Preparo y realizo la solicitud HTTP via AJAX
     $.ajax({
         headers:
         {
             'X-CSRF-TOKEN': csrfToken,
         },
         method: 'POST',
         url: route,
         data:
         {
             'id': id,
         },
         success: function(response)
         {
             // Recupero el componente asociado al boton
             let skinBtnDislike = document.getElementById('btn-dislike-skin-' + id);
             let componenteDislike = document.getElementById('dislikes_posteo_' + id);
             let dislikeActivado = response.data.activado;
             let huboSwitch = response.data.switch;
             let claseVieja;
             let claseNueva;
             // Determino la clase CSS a eliminar y por agregar, ademas de actualizar los 'me gusta'
             if (dislikeActivado)
             {
                 claseVieja = CLASE_NEUTRO;
                 claseNueva = CLASE_DISLIKE;
                 componenteDislike.innerHTML = '<b>' + response.data.dislikes + ' no me gusta </b>';
             }
             else
             {
                 claseVieja = CLASE_DISLIKE;
                 claseNueva = CLASE_NEUTRO;
                 componenteDislike.innerHTML = response.data.dislikes + ' no me gusta';
             }
             if (huboSwitch)
             {
                neutralizarBtnLike(id,response.data.likes);
             }
             
             // Elimino la clase CSS vieja e incorporo la nueva, modificando el color del boton
             skinBtnDislike.classList.remove(claseVieja);
             skinBtnDislike.classList.add(claseNueva);
 
 
         },
         error: function (response) {
             console.log('¡ERROR AL ACTUALIZAR para posteo ' + id + '!');
         }
     });
 }

 /**
  * Modifica el estilo y contenido del botón de 'me gusta' asociado
  * a un posteo, quedando en estado neutro (no seleccionado)
  */
 function neutralizarBtnLike(id, likes)
 {
    let skinBtnLike = document.getElementById('btn-like-skin-' + id);
    let componenteLike = document.getElementById('likes_posteo_' + id);
    componenteLike.innerHTML = likes + ' me gusta';
    skinBtnLike.classList.remove(CLASE_LIKE);
    skinBtnLike.classList.add(CLASE_NEUTRO);
 }

 /**
  * Modifica el estilo y contenido del botón de 'no me gusta' asociado
  * a un posteo, quedando en estado neutro (no seleccionado)
  */
 function neutralizarBtnDislike(id, likes)
 {
    let skinBtnLike = document.getElementById('btn-dislike-skin-' + id);
    let componenteLike = document.getElementById('dislikes_posteo_' + id);
    componenteLike.innerHTML = likes + ' no me gusta';
    skinBtnLike.classList.remove(CLASE_DISLIKE);
    skinBtnLike.classList.add(CLASE_NEUTRO);
 }


/**
 * Realiza una solicitud via AJAX al servidor para eliminar un
 * posteo del usuario en sesión, con id dado como como argumento.
 */
function eliminarPosteo (id, csrfToken, route)
{
    // Preparo y realizo la solicitud HTTP via AJAX
     $.ajax({
         headers:
         {
             'X-CSRF-TOKEN': csrfToken,
         },
         method: 'POST',
         url: route,
         data:
         {
             'id': id,
         },
         success: function(response)
         {
             // Recupero el componente asociado al sector ocupado por tarjeta y margen del posteo, y lo borro
             componenteEspacio = document.getElementById('espacio_posteo_' + id);
             componenteEspacio.remove();
         },
         error: function (response)
         {
             console.log('¡ERROR AL ELIMINAR posteo ' + id + '!');
         }
     });
}


/**
 * Solicita la actualizacion del estado de seguimiento, del usuario en sesion,
 * para un usuario con ID dado como argumento
 * @param id: id numerico del usuario sobre el cual actualizar el estado de
 * seguimiento
 * @param {*} csrfToken: string asociado al token CSRF
 * @param {*} route: URL a la cual realizar la solicitud de actualizacion
 */
function actualizarSeguimiento (id, csrfToken, route)
{
    // Preparo y realizo la solicitud HTTP via AJAX
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': csrfToken,
        },
        method: 'POST',
        url: route,
        data:
        {
            'id': id,
        },
        success: function(response)
        {
            // Recupero componentes asociados al boton de seguimiento y al contenedor del nro de seguidores
            let btnSeguimiento = document.getElementById('btn_seguimiento_' + id);
            let contSeguidores = document.getElementById('contenedor_seguidores_' + id);
            let nuevoSeguido = response.data.nuevo_seguido;
            let cantSeguidores = response.data.cant_seguidores_usuario;
            let claseVieja;
            let claseNueva;
            let contenidoBtn;
            // Determino el estilo del boton de seguimiento en base a si el seguido es nuevo o se borro
            if (nuevoSeguido)
            {
                claseVieja = 'estado-sin-seguir';
                claseNueva = 'estado-siguiendo';
                contenidoBtn = 'Dejar de seguir'
            }
            else
            {
                claseVieja = 'estado-siguiendo';
                claseNueva = 'estado-sin-seguir';
                contenidoBtn = 'Seguir';
            }
            // Actualizo el estilo del boton de seguimiento
            btnSeguimiento.classList.remove(claseVieja);
            btnSeguimiento.classList.add(claseNueva);
            btnSeguimiento.innerText = contenidoBtn;
            contSeguidores.innerHTML = '<b>' + cantSeguidores + '</b> seguidores';

        },
        error: function (response)
        {
            console.log('¡ERROR AL ACTUALIZAR SEGUIMIENTO sobre usuario ' + '!');
        }
    });
}


/**
 * Solicita la actualizacion del estado de suscripcion, del usuario en
 * sesion, para un topico con ID dado como argumento
 * @param id: id numerico del topico sobre el cual actualizar el estado de
 * suscripcion
 * @param {*} csrfToken: string asociado al token CSRF
 * @param {*} route: URL a la cual realizar la solicitud de actualizacion
 */
function requestActualizarSuscripcion (id, csrfToken, route)
{
    console.log(route);
    // Preparo y realizo la solicitud HTTP via AJAX
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': csrfToken,
        },
        method: 'POST',
        url: route,
        data:
        {
            'id': id,
        },
        success: function(response)
        {
            // Recupero componentes asociados al boton de suscripcion y al contenedor del nro de suscriptos
            let btnSuscripcion = document.getElementById('btn_suscripcion_' + id);
            let contSuscriptos = document.getElementById('contenedor_suscriptos_' + id);
            let nuevoSuscripto = response.data.nuevo_suscripto;
            let cantSuscriptos = response.data.cant_suscriptos_topico;
            let claseVieja;
            let claseNueva;
            let contenidoBtn;
            // Determino el estilo del boton de suscripcion en base a si hay nueva suscripcion o se borro
            if (nuevoSuscripto)
            {
                claseVieja = 'estado-sin-suscripcion';
                claseNueva = 'estado-suscripto';
                contenidoBtn = 'Anular suscripción';
            }
            else
            {
                claseVieja = 'estado-suscripto';
                claseNueva = 'estado-sin-suscripcion';
                contenidoBtn = 'Suscribirse';
            }
            // Actualizo el estilo del boton de suscripcion
            btnSuscripcion.classList.remove(claseVieja);
            btnSuscripcion.classList.add(claseNueva);
            btnSuscripcion.innerText = contenidoBtn;
            contSuscriptos.innerHTML = '<b>' + cantSuscriptos + '</b> seguidores';

        },
        error: function (response)
        {
            console.log('¡ERROR AL ACTUALIZAR SUSCRIPCION sobre topico ' + '!');
        }
    });
}
