@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Veículos</h1>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" id="newModelModal"
                    data-bs-target="#modelModal">
                    Novo Veículo
                </button>

                @include('admin.vehicle.components.create-modal')
                @include('admin.includes.messages')
                <table class="table table-bordered table-striped table-dark">
                    <thead>
                        <tr>
                            <th class='col-lg-3'></th>
                            <th>Descrição</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th class='col-lg-2 col-md-2'>Preço (R$)</th>
                            <th class='col-lg-1 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td class="align-middle text-center">
                                    <img class="card-img-top" style="width: 10rem !important;"
                                        @if ($vehicle->image) src="{{ $vehicle->image }}" @else src="https://free-psd-templates.com/wp-content/uploads/2020/03/Screenshot_18-750x500.webp" @endif
                                        alt="Card image cap">
                                </td>
                                <td class="align-middle">{{ $vehicle->description }}</td>
                                <td class="align-middle">{{ $vehicle->brand?->name }}</td>
                                <td class="align-middle">{{ $vehicle->model?->name }}</td>
                                <td class="align-middle text-end">{{ number_format($vehicle->price, 2, ',', '.') }}</td>
                                <td class="align-middle">
                                    @include('admin.vehicle.components.update-modal')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        id="updateModal-{{ $vehicle->id }}"
                                        data-bs-target="#updateModal-{{ $vehicle->id }}"><i class="material-icons">
                                            edit
                                        </i>
                                    </button>
                                    <button href="#delete" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $vehicle->id }}"><i class="material-icons">
                                            delete
                                        </i></button>
                                    @include('admin.vehicle.components.delete')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">Nenhum registro encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script></script>
@endsection
