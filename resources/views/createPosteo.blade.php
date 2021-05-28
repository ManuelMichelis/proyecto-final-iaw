<form method="POST">
    @csrf
    <div class="modal fade" id="createPosteo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4>Nuevo posteo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tópico</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                                <option>Topico 1</option>
                                <option>Topico 2</option>
                                <option>Topico 3</option>
                                <option>Topico 4</option>
                                <option>Topico 5</option>
                        </select>
                    </div>
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control">
                    <label for="contenido">Contenido</label>
                    <textarea type="text" name="contenido" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>
