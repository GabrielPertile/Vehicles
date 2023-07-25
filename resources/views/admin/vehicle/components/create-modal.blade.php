{{-- Modal de cadastro --}}
<div class="modal" tabindex="-1" id="modelModal">
    @if (count($errors) > 0 && old('id') == 'null')
        <script>
            $(document).ready(function() {
                $('#modelModal').modal('show');
            });
        </script>
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="modelModalLabel">Novo veículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modelForm" method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="null" />
                    <div class="mb-3">
                        <label for="image">Imagem*</label>
                        <input type="file" class="form-control" required name="image" id="image"
                            accept="image/png, image/jpeg, image/jpg" value="{{ old('image') }}">
                        @if (old('id') == 'null')
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description">Descrição*</label>
                        <textarea type="text" class="form-control" id="description" name="description" required
                            class="@error('description') is-invalid @enderror" value="{{ old('description') }}">
                        </textarea>
                        @if (old('id') == 'null')
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="brand_id">Marca*</label>
                        <select class="form-select form-select-sm" name="brand_id" id="brand_id" required
                            class="@error('brand_id') is-invalid @enderror">
                            <option value="">Escolha uma marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (old('id') == 'null')
                            @error('brand_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="model_id">Modelo*</label>
                        <select class="form-select form-select-sm" name="model_id" id="model_id" required
                            class="@error('model_id') is-invalid @enderror">
                            <option value="">Escolha um modelo</option>
                        </select>
                        @if (old('id') == 'null')
                            @error('model_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="price">Valor (R$)*</label>

                        <input type="number" min="0.00" step="0.01" class="form-control" id="price" required
                            name="price" required class="@error('price') is-invalid @enderror"
                            value="{{ old('price') }}" />
                        </textarea>
                        @if (old('id') == 'null')
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
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
<script>
    let brands = @json($brands);
    console.log(brands);
    document.getElementById('brand_id').addEventListener('change', function() {
        let brandId = this.value;
        console.log(brandId);
        if (brandId) {

            let selectedBrand = brands.find(brand => brand.id === parseInt(brandId));

            console.log(selectedBrand);
            let modelSelect = document.getElementById('model_id');
            modelSelect.innerHTML = '<option value="">Escolha um modelo</option>';
            selectedBrand.models.forEach(model => {
                let option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;

                // Check if the model ID matches the old('model_id') value
                @if (old('model_id'))
                    if ({{ old('model_id') }} === model.id) {
                        option.selected = true;
                    }
                @endif
                modelSelect.appendChild(option);
            });
        } else {}
    });
</script>
