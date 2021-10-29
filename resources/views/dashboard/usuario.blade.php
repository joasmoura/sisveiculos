<x-site-layout>
    <x-slot name="header">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <h1 class="">Veículos o usuário <b>{{$usuario->name}})</b></h1>
            <a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a>
        </div>
    </x-slot>

    <div class="bg-light py-5 p-5 rounded">
        <div class="row">
            @forelse($usuario->veiculos()->get() as $veiculo)
                <a href="{{route('veiculo', [$usuario->uri, $veiculo->uri])}}" class="col-md-3">
                    <div class="card">
                        <img src="{{$veiculo->fotos()->first()->foto}}" class="card-img-top" alt="{{$veiculo->modelo}}">
                    </div>
                </a>
            @empty
            @endforelse
        </div>
        
    </div>

</x-site-layout>