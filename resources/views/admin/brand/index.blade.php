@extends('layouts.app')

{{-- @include('admin.brand.components.update-brand-modal') --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Marcas</h1>
                {{-- <button class="btn btn-primary mb-3" onclick="openCreateDialog()">Add Brand</button> --}}
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" id="newBrandModal"
                    data-bs-target="#brandModal">
                    Nova marca
                </button>

                @include('admin.brand.components.brand-modal')
                @include('admin.includes.messages')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class='col-lg-1'>ID</th>
                            <th>Nome</th>
                            <th class='col-lg-2 float-right'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>#{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td class="float-right">
                                    {{-- <button class="btn btn-sm btn-primary" id="updateBrandModal"
                                        data-bs-target="#updateBrandModal" data-bs-toggle="modal"
                                        data-id="{{ $brand->id }}">Editar</button> --}}
                                    @include('admin.brand.components.update-modal')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        id="updateModal" data-bs-target="#updateModal">
                                        Editar
                                    </button>
                                    @include('admin.brand.components.update-modal')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $brand->id }}">Remover</button>
                                    @include('admin.brand.components.delete')
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
    <script>

    </script>
@endsection
