{{-- Modal de edição --}}
<div class="modal" tabindex="-1" id="updateModal-{{ $vehicle->id }}">
    @if (count($errors) > 0 && old('id') == $vehicle->id)
        <script>
            $(document).ready(function() {
                var vehicleId = {{ $vehicle->id }};

                $("#updateModal-" + vehicleId).modal('show');
            });
        </script>
    @endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="updateModalLabel">Editar veículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modelForm" method="POST" action="{{ route('vehicles.update', $vehicle->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $vehicle->id }}" />

                    <div class="mb-3">
                        <label for="image">Imagem</label>
                        <input type="file" class="form-control" @required(!$vehicle->image) name="image"
                            accept="image/png, image/jpeg, image/jpg">
                        @if ($vehicle->image)
                            <img class="mt-3" style="width: 10rem;" src="{{ $vehicle->image }}" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description">Descrição*</label>
                        <textarea class="form-control" id="description" name="description" required
                            class="@error('description') is-invalid @enderror"
                            value="{{ old('description') ? old('description') : $vehicle->description }}">
                            {{ old('description') ? old('description') : $vehicle->description }}
                        </textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brand_id">Marca*</label>
                        <select class="form-select form-select-sm" name="brand_id" id="brand_id" required
                            class="@error('brand_id') is-invalid @enderror">
                            <option value="">Escolha uma marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id') ? old('brand_id') == $brand->id : $vehicle->brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="model_id">Modelo*</label>
                        <select class="form-select form-select-sm" name="model_id" id="model_id" required
                            class="@error('model_id') is-invalid @enderror">
                            <option value="">Escolha um modelo</option>
                        </select>
                        @error('model_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price">Valor (R$)*</label>

                        <input type="number" min="0.00" step="0.01" class="form-control" id="price"
                            name="price" required class="@error('price') is-invalid @enderror"
                            value="{{ old('price') ? old('price') : $vehicle->price }}" />
                        </textarea>
                        @error('price')
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
<script>
    // Adiciona eventos de change no campo marca para atualizar modelos
    function setupUpdateModalListeners() {
        let outerElement = document.getElementById("updateModal-{{ $vehicle->id }}")
        let innerElement = outerElement.querySelector('#brand_id')
        innerElement.addEventListener('change', function() {
            let brandId = this.value;
            if (brandId) {

                let selectedBrand = brands.find(brand => brand.id === parseInt(brandId));

                let modelSelect = outerElement.querySelector('#model_id');
                modelSelect.innerHTML = '<option value="">Escolha um modelo</option>';
                selectedBrand.models.forEach(model => {
                    let option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;

                    @if (old('model_id'))
                        if ({{ old('model_id') }} === model.id) {
                            option.selected = true;
                        }
                    @else
                        {{ $vehicle->model->id }}
                    @endif
                    modelSelect.appendChild(option);
                });
            } else {}
        });
    }

    // Para abrir e já carregar marca e modelo
    function loadBrandAndModelFieldOnShow() {
        var myModal = document.getElementById("updateModal-{{ $vehicle->id }}");

        myModal.addEventListener("shown.bs.modal", function() {
            let vehicle = @json($vehicle);
            let outerElement = document.getElementById("updateModal-{{ $vehicle->id }}")
            let innerElement = outerElement.querySelector('#brand_id')
            innerElement.value = vehicle.brand.id
            let brandInputValue = innerElement.value;
            let selectedBrand = brands.find(brand => brand.id === parseInt(brandInputValue));
            let modelSelect = outerElement.querySelector('#model_id')

            modelSelect.innerHTML = '<option value="">Escolha um modelo</option>';
            selectedBrand.models.forEach(model => {
                console.log(model);
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
                modelSelect.value = vehicle.model.id
            });
        });
    }

    // Adiciona eventos de change no campo marca para atualizar modelos
    document.addEventListener('DOMContentLoaded', setupUpdateModalListeners);

    // Para abrir e já carregar marca e modelo
    document.addEventListener("DOMContentLoaded", loadBrandAndModelFieldOnShow);
</script>
