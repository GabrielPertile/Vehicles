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
                            <th class='col-lg-1'>ID</th>
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
                                <td>#{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->description }}</td>
                                <td>{{ $vehicle->brand?->name }}</td>
                                <td>{{ $vehicle->model?->name }}</td>
                                <td>{{ number_format($vehicle->price, 2, ',', '.') }}</td>
                                <td class="float-right">
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
