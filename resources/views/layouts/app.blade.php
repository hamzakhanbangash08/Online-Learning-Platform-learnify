<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tailwind (agar chahiye to Vite se use karna) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
         body{
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fce0e8 0%, #ffffff 100%);
           
        }
    </style>
</head>

<body class="bg-light">
    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4 py-2">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="ms-auto">
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-outline-primary btn-sm mx-1" href="{{ route('login') }}">Login</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-primary btn-sm mx-1" href="{{ route('register') }}">Register</a>
                    @endif
                @else
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" id="userMenu" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.view') }}">Profile</a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </nav>

            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
