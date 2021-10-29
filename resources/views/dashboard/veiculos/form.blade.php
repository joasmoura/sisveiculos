<x-painel-layout>
    <x-slot name="header">
        <div  class="d-flex flex-row align-items-center justify-content-between">
            <h2 class="">
                {{ __((isset($veiculo) ? 'Editar Veículo' : 'Novo Cadastro de Veículo')) }}
            </h2>

            <div>
                <a href="{{route('painel.index')}}" class="btn btn-primary"><i class="fa fa-list"></i> Veículos</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <form name="formVeiculo" action="{{ (isset($veiculo) ? route('painel.veiculos.update', $veiculo->id) : route('painel.veiculos.store')) }}" method="post">
            @if(isset($veiculo))
                <input type="hidden" name="id" value="{{$veiculo->id}}">
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" class="form-control"  value="{{ (isset($veiculo) && !empty($veiculo->modelo) ? $veiculo->modelo : '')}}" placeholder="Modelo" id="modelo">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" name="placa" value="{{ (isset($veiculo) && !empty($veiculo->placa) ? $veiculo->placa : '')}}" class="form-control" placeholder="Placa" id="placa">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" class="form-control custom-select" placeholder="Tipo" id="tipo">
                            <option value=""></option>
                            <option value="carro" {{ (isset($veiculo) && $veiculo->tipo === 'carro' ? 'selected' : '')}}>Carro</option>
                            <option value="moto" {{ (isset($veiculo) && $veiculo->tipo === 'moto' ? 'selected' : '')}}>Moto</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cor">Cor</label>
                        <input type="text" name="cor" value="{{ (isset($veiculo) && !empty($veiculo->cor) ? $veiculo->cor : '')}}" class="form-control" placeholder="Cor" id="cor">
                    </div>
                </div>

                <div class="col-md-12 py-3">
                    <h5>Fotos</h5>

                    <input type="file" name="fotos[]" multiple accept="image/*" class="form-control">
                </div>

                @if(isset($veiculo))
                    @forelse($veiculo->fotos()->get() as $foto)
                      <div class="card" style="width: 18rem;">
                        <img src="{{Storage::url($foto->url)}}" class="card-img-top">
                      </div>
                    @empty

                    @endforelse
                @endif

                <div class="col-md-12 py-3 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</x-painel-layout>
