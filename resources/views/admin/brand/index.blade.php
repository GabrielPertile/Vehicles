@extends('layouts.app')

@include('admin.brand.components.brand-modal')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Marcas</h1>
                {{-- <button class="btn btn-primary mb-3" onclick="openCreateDialog()">Add Brand</button> --}}
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#brandModal">
                    Nova marca
                  </button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                        >Editar</button>
                                    <button class="btn btn-sm btn-danger"
                                        >Remover</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        let brands = @json($brands);

        // The rest of the JavaScript remains the same...
    </script>
@endsection
