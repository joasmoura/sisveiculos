<x-painel-layout>
    <x-slot name="header">
        <h2 class="">{{ auth()->user()->name }}</h2>
    </x-slot>

    <div class="py-12">
        <form name="formUsuario" action="{{ route('painel.usuarios.salvarPerfil') }}" method="post">
            <input type="hidden" name="id" value="{{auth()->user()->id}}">
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" required name="name" value="{{ (!empty(auth()->user()->name) ? auth()->user()->name : oud('name')) }}" class="form-control" placeholder="Nome">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" required name="email" value="{{ (!empty(auth()->user()->email) ? auth()->user()->email : oud('email')) }}" class="form-control" placeholder="Email">
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