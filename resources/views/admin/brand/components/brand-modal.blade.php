{{-- Modal de cadastro --}}
<div class="modal" tabindex="-1" id="brandModal" style="@error('name') display:block @enderror">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brandModalLabel">Nova marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandForm" method="POST" action="{{ route('brands.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="upname" name="upname" required
                            class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
