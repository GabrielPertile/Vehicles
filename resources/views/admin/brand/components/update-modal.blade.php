{{-- Modal de update --}}
<div class="modal" tabindex="-1" id="updateModal">
    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#updateModal').modal('show');
            });
        </script>
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandForm" method="POST" action="{{ route('brands.update', $brand->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            class="@error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $brand->name}}">
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
