@extends('layouts.app')

@include('admin.brand.components.brand-modal')
@include('admin.brand.components.update-brand-modal')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Marcas</h1>
                {{-- <button class="btn btn-primary mb-3" onclick="openCreateDialog()">Add Brand</button> --}}
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" id="brandModal"
                    data-bs-target="#brandModal">
                    Nova marca
                </button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class='col-lg-1'>Id</th>
                            <th>Nome</th>
                            <th class='col-lg-2 float-right'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td class="float-right">
                                    <button class="btn btn-sm btn-primary" id="updateBrandModalBtn"
                                        data-bs-target="#updateBrandModal"
                                        onclick="openEditDialog({{ $brand->id }})">Editar</button>
                                    <button class="btn btn-sm btn-danger">Remover</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        function openEditDialog(brandId) {
            console.log(brandId);
            // Fetch the brand data using the show route
            $.ajax({
                type: 'GET',
                url: `api/brands/${brandId}`,

                dataType: 'json',
                success: function(response) {
                    const responseData = response.data;

                    console.log(responseData);

                    $('#updateBrandModal').modal('show');
                    // $('#updateBrandForm').attr('action', '/brands/' + responseData.id);
                    $('#name').val(responseData.name);
                    $('#brandId').val(responseData.id);
                },
                error: function(xhr) {
                    alert('Error fetching brand data.');
                }
            });
        }
    </script>
@endsection
