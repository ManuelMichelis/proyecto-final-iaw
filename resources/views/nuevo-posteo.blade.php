<form method="POST">
    <link rel="stylesheet" href="css/app.css">
    @csrf
    <div class="modal fade" id="modal-crear-posteo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <b>
                        <h3>Nuevo posteo</h3>
                    </b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!--label for="topico">Tópico</!--label-->
                        <select name="topico" class="form-control" aria-placeholder="Tópico">
                            @foreach ($topicos as $topico)
                                <option>{{ $topico->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <!--label for="titulo">Título</!--label-->
                        <input type="text" name="titulo" class="form-control" placeholder="Titulo del posteo">
                    </div>
                    <div class="form-group">
                    <!--label for="contenido">Contenido</!--label-->
                    <textarea type="text" name="contenido" class="form-control"placeholder="Desarrollo del contenido del posteo" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>
