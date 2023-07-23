@extends('layouts.app')

@section('content')
    <div class="row container">
        @forelse ($vehicles as $vehicle)
            <div class="col-sm-12 col-md-4 mb-3">
                <div class="card">
                    <img class="card-img-top" style="max-height: 265px !important"
                        @if ($vehicle->image) src="{{ $vehicle->image }}" @else src="https://free-psd-templates.com/wp-content/uploads/2020/03/Screenshot_18-750x500.webp" @endif
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->brand->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $vehicle->model->name }}</h6>

                        <div class="card-text" title="{{ $vehicle->description }}">
                            {{ Str::limit($vehicle->description, 200, '...') }}
                        </div>
                        <h6 class="card-title">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</h6>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="12">Nenhum registro encontrado</td>
            </tr>
        @endforelse
    </div>
@endsection
