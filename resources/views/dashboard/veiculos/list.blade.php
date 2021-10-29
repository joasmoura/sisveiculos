<x-painel-layout>
    <x-slot name="header">
        <div  class="d-flex flex-row align-items-center justify-content-between">
            <h2 class="">
                {!! "Veículos do usuário <b>{$usuario->name}</b>" !!}
            </h2>

            <div>
                <a href="{{route('painel.usuarios.index')}}" class="btn btn-primary"><i class="fa fa-undo"></i> Usuários</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="row">
            @forelse($veiculos as $veiculo)
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{Storage::url($veiculo->fotos()->first()->url)}}" class="card-img-top" alt="{{$veiculo->modelo}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$veiculo->modelo}} ({{ ($veiculo->tipo == 'moto' ? 'Moto' : 'Carro') }})</h5>
                            <p class="card-text">Placa {{$veiculo->placa}}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</x-painel-layout>
