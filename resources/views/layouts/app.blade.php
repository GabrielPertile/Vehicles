<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Vehicles') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Your custom CSS -->
    <style>
        /* Add your custom CSS styles here */
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Vehicles') }}</a>
            </div>
            @auth
                <div style="display: flex;">
                    <div class="dropdown" style="margin-right: 1rem">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('brands.index') }}">Marcas</a>
                            <a class="dropdown-item" href="{{ route('models.index') }}">Modelos</a>
                            <a class="dropdown-item" href="{{ route('vehicles.index') }}">Veículos</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAuth"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Olá {{ auth()->user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAuth">
                            <a class="dropdown-item" style="display: flex; align-items: center;"
                                href="{{ route('login.logout') }}">Logout<i class="material-icons">
                                    logout
                                </i></a>
                        </div>
                    </div>
                </div>
            @else
                <a class="btn btn-secondary" type="button"
                    style="display: flex; justify-content: center; align-items: center;"
                    href="{{ route('login.form') }}">Login<i class="material-icons">login
                    </i></a>
            </div>
        @endauth
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper.js (for Bootstrap's dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
