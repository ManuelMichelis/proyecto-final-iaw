<form method="POST">
    @csrf
    <div class="modal fade" id="modal-nuevo-posteo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <div class="col text-center">
                        <h5>
                            <b>
                                Nuevo posteo
                            </b>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="topico" class="form-control" aria-placeholder="Tópico">
                            <option> Vacío </option>
                            @foreach ($topicos as $topico)
                                <option>{{ $topico->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input
                            type="text"
                            name="titulo"
                            class="form-control"
                            placeholder="Título del posteo (ayuda: idea principal del tema)"
                        >
                    </div>
                    <div class="form-group">
                        <textarea
                            type="text"
                            name="contenido"
                            class="form-control"
                            placeholder="Contanos de qué se trata este nuevo tema" rows="8"
                        >
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-button>
                        ¡Publicar!
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</form>
