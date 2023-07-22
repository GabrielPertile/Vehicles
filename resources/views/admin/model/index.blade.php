@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Modelo</h1>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" id="newModelModal"
                    data-bs-target="#modelModal">
                    Novo modelo
                </button>

                @include('admin.model.components.create-modal')
                @include('admin.includes.messages')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class='col-lg-1'>ID</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th class='col-lg-2 float-right'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $model)
                            <tr>
                                <td>#{{ $model->id }}</td>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->brand->name }}</td>
                                <td class="float-right">
                                    @include('admin.model.components.update-modal')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        id="updateModal-{{$model->id}}" data-bs-target="#updateModal-{{$model->id}}">
                                        Editar
                                    </button>
                                    <button href="#delete" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $model->id }}">Remover</button>
                                    @include('admin.model.components.delete')
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
