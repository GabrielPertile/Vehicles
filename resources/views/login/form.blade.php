@extends('layouts.app')

@section('content')
    <div class="container" style="min-width: 40%; max-width: 30%;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form id="login-form" method="POST" action="{{ route('login.auth') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                class="@error('password') is-invalid @enderror" value="{{ old('password') }}">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($message = Session::get('erro'))
                            <span class="text-danger">{{ $message }}</span>
                        @endif
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    <button class="btn btn-primary" type="submit" id="formSubmit">Login</button>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    @endsection
