

/**
 * Realiza una solicitud via AJAX al servidor para actualizar el registro
 * del "me gusta" sobre el posteo con id dado como argumento.
 */
function requestVotar (id, csrfToken, route)
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
        success: function(response){
            // Recupero el componente asociado al boton y lo pinto, si se agreg
            skinBtn = document.getElementById('btn-mg-skin-' + id);
            componenteVotos = document.getElementById('votos_posteo_' + id);
            let gustado = response.data.gustado;
            let votos = response.data.votos;
            let claseVieja;
            let claseNueva;
            // Determino la clase CSS a eliminar y por agregar, ademas de actualizar los 'me gusta'
            if (gustado)
            {
                claseVieja = 'estado-no-gustado';
                claseNueva = 'estado-gustado';
                componenteVotos.innerHTML = '<b>' + votos + ' me gusta </b>';
            }
            else
            {
                claseVieja = 'estado-gustado';
                claseNueva = 'estado-no-gustado';
                componenteVotos.innerHTML = votos + ' me gusta';
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
 * del "me gusta" sobre el posteo con id dado como argumento.
 */
function requestEliminar (id, csrfToken, route)
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
function requestActualizarSeguimiento (id, csrfToken, route)
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
            let btnSeguimiento = document.getElementById('btn_seguimiento');
            let contSeguidores = document.getElementById('contenedor_seguidores');
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
