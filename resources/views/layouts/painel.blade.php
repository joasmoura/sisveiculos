<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="BASE" content="{{ env('APP_URL') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{route('painel.index')}}">Sisveículos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @if(auth()->user()->perfil === 'admin')
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('painel.usuarios.index')}}">Usuários</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('painel.usuarios.desativados')}}">Usuários Desativados</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link " href="{{env('APP_URL')}}" target="_blank"><i class="fa fa-eye"></i> Mais veículos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link excluirUsuario" href="{{route("painel.usuarios.destroy", auth()->user()->id)}}" target="_blank"><i class="fa fa-trash"></i> Deletar conta</a>
                        </li>
                    </ul>
                </div>

                <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                    <li class="nav-item col-6 col-md-auto">
                        <a href="{{route("painel.usuarios.perfil")}}" class="nav-link p-2">{{auth()->user()->name}}</a>
                    </li>

                    <li class="nav-item col-6 col-md-auto">
                        <a href="{{route("painel.sair")}}" class="nav-link p-2" title="sair"><i class="fa fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </nav>

        <header class="container">
            {{ $header }}
        </header>

        <main class="container">
            {{ $slot }}
        </main>

        <!-- Scripts -->
        <script src="{{ asset('assets/js/jquery.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/jquery.form.js') }}" defer></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}" defer></script>
        <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
    </body>
</html>
