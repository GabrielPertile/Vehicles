@if ($message = Session::get('message'))
    <div class="card bg-success text-white mb-3">
        <div class="card-body">
            <h5 class="card-title">Parabéns</h5>
            <p class="card-text"> {{ $message }}</p>
        </div>
    </div>
@endif
