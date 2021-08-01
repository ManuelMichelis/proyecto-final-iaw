<form method="POST" action="{{ route('nuevoComentario', ['id' => $posteo->id]) }}">
    @csrf
    <div class="modal fade" id="modal-nuevo-comentario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <div class="col text-center">
                        <h5>
                            <b>
                                Nuevo comentario
                            </b>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <textarea
                        type="text"
                        name="contenido"
                        class="form-control"
                        placeholder="Brindá una opinión acerca del tema en discusión" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-dark" value="Publicar">
                </div>
            </div>
        </div>
    </div>
</form>
