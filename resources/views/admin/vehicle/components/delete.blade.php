{{-- Modal de remoção --}}
<div class="modal" tabindex="-1" id="delete-{{ $vehicle->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modelModalLabel">Atenção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
                <p>Tem certeza que deseja excluir este veículo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" id="formSubmit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
