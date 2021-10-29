<x-site-layout>
    <x-slot name="header">
        <h1 class="">Gerencie seus veículos</h1>
    </x-slot>

    <div class="bg-light py-5 p-5 rounded">
        <p class="lead">Não perca tempo, anuncie seus veículos de forma rápida e gratuitamente</p>
        
        @if(auth()->check())
            <a class="btn btn-lg btn-primary" href="{{route('painel.index')}}" role="button">Painel »</a>
        @else
            <a class="btn btn-lg btn-default" href="{{route('login')}}" role="button">Já sou cadastrado »</a>
            <a class="btn btn-lg btn-primary" href="{{route('register')}}" role="button">Quero me cadastrar »</a>
        @endif
    </div>

    <div class="row">
        @if(isset($veiculos))
            @forelse($veiculos as $veiculo)
            @if($veiculo->usuario)
                <a href="{{route('veiculo', [$veiculo->usuario->uri,$veiculo->uri])}}" class="col-md-3 my-2">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$veiculo->fotos()->first()->foto}}" class="card-img-top imagem-carro" alt="{{$veiculo->modelo}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$veiculo->modelo}} ({{ ($veiculo->tipo == 'moto' ? 'Moto' : 'Carro') }})</h5>
                            <p class="card-text">Placa {{$veiculo->placa}}</p>
                        </div>
                    </div>
                </a>
            @endif
            @empty
            @endforelse
            
            
            <div class="col-md-12">
                {{$veiculos->links()}}
            </div>
        @endif
    </div>

</x-site-layout>