{{-- Modal de edição --}}
<div class="modal" tabindex="-1" id="updateModal-{{ $model->id }}">
    @if (count($errors) > 0 && old('id') == $model->id)
        {{-- <script>
            $(document).ready(function() {
                var modelId = {{ $model->id }};

                $("#updateModal-" + modelId).modal('show');
            });
        </script> --}}
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar modelo - {{$model->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modelForm" method="POST" action="{{ route('models.update', $model->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{ $model->id }}" />
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            class="@error('name') is-invalid @enderror"
                            value="{{ old('name') ? old('name') : $model->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brand_id">Marca</label>
                        <select class="form-select form-select-sm" name="brand_id" id="brand_id" required
                            class="@error('brand_id') is-invalid @enderror">
                            <option value="">Escolha uma marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id') ? old('brand_id') == $brand->id : $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
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
