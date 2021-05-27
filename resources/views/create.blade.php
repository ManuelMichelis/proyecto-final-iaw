<form method="POST" v-on:submit.prevent="createKeep">

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
                    <label for="keep">Titulo</label>
                    <input type="text" name="keep" class="form-control" v-model="newKeep">
                    <label for="keep">Mensaje</label>
                    <input type="text" name="keep" class="form-control" v-model="newKeep">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>

</form>
