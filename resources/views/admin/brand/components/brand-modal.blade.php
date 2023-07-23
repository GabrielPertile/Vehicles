{{-- Modal de cadastro --}}
<div class="modal" tabindex="-1" id="brandModal">
    @if (count($errors) > 0 && old('id') == 'null')
        <script>
            // var oldData = {!! json_encode(old()) !!};
            // console.log(oldData);
            $(document).ready(function() {
                $('#brandModal').modal('show');
            });
        </script>
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="brandModalLabel">Nova marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandForm" method="POST" action="{{ route('brands.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="null" />
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
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
