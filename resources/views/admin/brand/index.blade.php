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
                <table class="table table-bordered table-striped table-dark">
                    <thead>
                        <tr>
                            <th class='col-lg-1'>ID</th>
                            <th>Nome</th>
                            <th class='col-lg-1 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>#{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td class="float-right">
                                    @include('admin.brand.components.update-modal')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        id="updateModal-{{ $brand->id }}"
                                        data-bs-target="#updateModal-{{ $brand->id }}">
                                        <i class="material-icons">
                                            edit
                                        </i>
                                    </button>
                                    @include('admin.brand.components.update-modal')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $brand->id }}"><i class="material-icons">
                                            delete
                                        </i></button>
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
    <script></script>
@endsection
