{{-- Modal de cadastro --}}
<div class="modal" tabindex="-1" id="modelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelModalLabel">Novo modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modelForm" method="POST" action="{{ route('models.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control validate" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary" type="submit" id="formSubmit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
