{{-- Modal de update --}}
<div class="modal" tabindex="-1" id="updateModal-{{ $brand->id }}">
    @if (count($errors) > 0 && old('id') == $brand->id)
        <script>
            // var oldData = {!! json_encode(old()) !!};
            // var brand = {!! json_encode($brand) !!};
            // console.log(oldData);
            // console.log(brand);
            $(document).ready(function() {
                var brandId = {{ $brand->id }};

                $("#updateModal-" + brandId).modal('show');
            });
        </script>
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="updateModalLabel">Editar marca - {{ $brand->name }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandForm" method="POST" action="{{ route('brands.update', $brand->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <input type="hidden" name="id" value="{{ $brand->id }}" />
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            class="@error('name') is-invalid @enderror"
                            value="{{ old('name') ? old('name') : $brand->name }}">
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
