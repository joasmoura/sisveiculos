<x-painel-layout>
    <x-slot name="header">
        <div  class="d-flex flex-row align-items-center justify-content-between">
            <h2 class="">
                {{ __((auth()->user()->perfil == 'usuario' ? 'Meus veículos' : 'Painel')) }}
            </h2>

            <div>
                <a href="{{route('painel.veiculos.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Veículo</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="row">
            @forelse(auth()->user()->veiculos()->get() as $veiculo)
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$veiculo->fotos()->first()->foto}}" class="card-img-top imagem-carro" alt="{{$veiculo->modelo}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$veiculo->modelo}} ({{ ($veiculo->tipo == 'moto' ? 'Moto' : 'Carro') }})</h5>
                            <p class="card-text">Placa {{$veiculo->placa}}</p>
                            <a href="{{route('painel.veiculos.edit', $veiculo->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                            <a href="{{route('painel.veiculos.destroy', $veiculo->id)}}" class="btn btn-danger excluirVeiculo"><i class="fa fa-trash"></i> Excluir</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</x-painel-layout>
