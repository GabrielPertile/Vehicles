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
                                    <button class="btn btn-sm btn-primary" id="updateBrandModal"
                                        data-bs-target="#updateBrandModal" data-id="{{ $brand->id }}"
                                        value="{{ $brand->id }}">Editar</button>
                                    <button href="#delete" class="btn btn-sm btn-danger" data-bs-toggle="modal"
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
        $(document).ready(function() {
            var brandId; // To store the brand ID when editing

            // Handle edit button click (Open the modal in edit mode)
            $(document).on('click', '#updateBrandModal', function() {
                var brandId = $(this).val();
                // alert(brandId)
                // Fetch the brand data using the show route
                $.ajax({
                    type: 'GET',
                    url: `/brands/${brandId}`,

                    dataType: 'json',
                    success: function(response) {
                        const responseData = response.data;
                        $('#brandId').val(responseData.id);
                        console.log(responseData);

                        brandId = responseData.id;
                        let updateUrl = '{{ route('brands.update', ':id') }}';
                        updateUrl = updateUrl.replace(':id', brandId);

                        $('#name').val(responseData.name);
                        $('#brandForm').attr('action', updateUrl).attr('method', 'PUT');
                        $('#brandModal').modal('show');
                        $('#brandId').val(responseData.id);
                    },
                    error: function(xhr) {
                        alert('Error fetching brand data.');
                    }
                });
            });

            // Handle add new brand button click (Open the modal in create mode)
            $(document).on('click', '#newBrandModal', function() {
                var brandId = null;
                let createUrl = '{{ route('brands.store') }}';

                $('#name').val('');
                $('#brandForm').attr('action', createUrl).attr('method', 'POST');
                $('#brandModal').modal('show');
            });
        });
        // // Aqui seta valor
        // function openmodal() {

        //     brandId = null;
        //     let createUrl = '{{ route('brands.store') }}';
        //     $('#brandModal').modal('show');
        //     $('#brandForm').attr('action', createUrl).attr('method', 'POST');

        //     $('#name').val(null);
        // }

        // function openEditDialog(brandId) {
        //     // Fetch the brand data using the show route
        //     $.ajax({
        //         type: 'GET',
        //         url: `/brands/${brandId}`,

        //         dataType: 'json',
        //         success: function(response) {
        //             const responseData = response.data;

        //             console.log(brandId);
        //             console.log(responseData);
        //             brandId = $(this).data('id');
        //             console.log(brandId);
        //             $('#brandModal').modal('show');
        //             $('#brandForm').attr('action', '/brands/' + responseData.id);
        //             $('#brandForm').attr('method', 'PUT');
        //             $('#upname').val(responseData.name);
        //             $('#brandId').val(responseData.id);
        //         },
        //         error: function(xhr) {
        //             alert('Error fetching brand data.');
        //         }
        //     });
        // }
    </script>
@endsection
