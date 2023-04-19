<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Scripts -->


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2.select2-container.select2-container--classic {
            width: 100% !important;
        }
    </style>

    <script src="https://use.fontawesome.com/0a4b7a1aa5.js"></script>
    @yield('style')
    {{--  @vite(['resources/sass/app.scss', 'resources/js/app.js'])  --}}
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-green shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <p>Todo App</p>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @can('update_task')
                                <a class="btn btn-warning" title="send mail to all today tasks"
                                    href="{{ route('task.sendToAll') }}">
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                            @endcan

                        @endguest
                    </ul>
                </div>
                @can('read_notifications')
                    <li class="nav-item dropdown">

                        <a class="me-3 btn btn-success dropdown-toggle" href="#" role="button" aria-expanded="false"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-bell"></i>
                            <span
                                class="badge rounded-pill badge-notification bg-danger">{{ count($notifications) }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" id="notifications_dropdown"
                            aria-labelledby="navbarDropdown">

                            @forelse($notifications as $notification)
                                <div>
                                    <p class="dropdown-item">{{ $notification->data['title'] }} due date in 24
                                        hours
                                        <a href="{{ route('task.markNotification', $notification->id) }}"
                                            title="Mark as read" class="float-right mark-as-read m-2"
                                            data-id="{{ $notification->id }}">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </p>

                                </div>
                                @if ($loop->last)
                                    <p>
                                        <a href="{{ route('task.markNotification') }}" id="mark-all"
                                            class="m-auto float-right btn btn-dark">
                                            Mark all as read
                                        </a>
                                    </p>
                                @endif
                            @empty
                                <p class="text-danger m-2"> no notifications</p>
                            @endforelse


                        </div>
                    </li>
                @endcan
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @yield('scripts')
</body>

</html>
