
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Crear</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('dashboard') }}">
                @csrf
                    <div class="form-group input-group">
                        <label for="keep" class="form-control">Titulo</label>
                        <input type="text" name="Titulo" class="form-control">
                    </div>
                    <div class="form-group input-group">
                        <label for="keep" class="form-control">Mensaje</label>
                        <input type="text" name="Mensaje" class="form-control">
                    </div>
                    <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Crear Posteo </button>
                    </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

