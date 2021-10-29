<x-site-layout>
    <x-slot name="header">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <h1 class="">{{$veiculo->modelo}} ({{$usuario->name}})</h1>
            <a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a>
            <a href="{{route('usuario', $usuario->uri)}}"><i class="fa fa-undo"></i>Voltar</a>
        </div>
    </x-slot>

    <div class="bg-light py-5 p-5 rounded">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    @forelse($veiculo->fotos()->get() as $foto)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{$foto->foto}}" class="card-img-top" alt="{{$veiculo->modelo}}">
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><b>Placa:</b> {{$veiculo->placa}}</li>
                    <li class="list-group-item"><b>Cor:</b> {{$veiculo->cor}}</li>
                    <li class="list-group-item"><b>Tipo:</b> {{$veiculo->tipo}}</li>
                  </ul>
            </div>
        </div>
        
    </div>

</x-site-layout>