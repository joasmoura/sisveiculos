<x-painel-layout>
    <x-slot name="header">
        <h2 class="">{!! (isset($usuario) ? "Editar Usuario <b>{$usuario->name}</b>" : 'Cadastrar' ) !!}</h2>
    </x-slot>

    <div class="py-12">
        <form name="formUsuario" action="{{ (isset($usuario) ? route('painel.usuarios.update', $usuario->id) : route('painel.usuarios.store')) }}" method="post">
            @if(isset($usuario))
                <input type="hidden" name="id" value="{{$usuario->id}}">
                @method('PUT')
            @endif
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" required name="name" value="{{ (isset($usuario) && !empty($usuario->name) ? $usuario->name : oud('name')) }}" class="form-control" placeholder="Nome">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" required name="email" value="{{ (isset($usuario) && !empty($usuario->email) ? $usuario->email : oud('email')) }}" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar Senha">
                    </div>
                </div>

                <div class="col-md-6 text-right py-3">
                    <button type="submit" class="btn btn-success" title="Salvar" ><i class="fa fa-save"></i> Salvar</button>
                </div>

            </div>
        </form>
    </div>
</x-painel-layout>