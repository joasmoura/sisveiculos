<x-painel-layout>
    <x-slot name="header">
        <h2 class="">Usuários</h2>
    </x-slot>

    <div class="py-12">
       <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Carros</th>
                    <th></th>
                </thead>

                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td></td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->veiculos()->count()}}</td>
                        <td>
                            
                            
                            @if(!empty($usuario->deleted_at))
                                <a href="{{ route('painel.usuarios.destroy_permanente', $usuario->id) }}" 
                                    class="btn btn-danger btn-sm excluirUsuarioPermanentemente" title="Excluir Usuário"><i class="fa fa-trash"></i> Excluir permanentemente</a>
                                <a href="{{route('painel.usuarios.restaurar', $usuario->id)}}" class="btn btn-success btn-sm" title="Restaurar Usuário"><i class="fa fa-edit"></i> Restaurar usuário</a>
                            @else
                                <a href="{{route('painel.usuarios.destroy', $usuario->id) }}" 
                                    class="btn btn-danger btn-sm excluirUsuario" title="Excluir Usuário"><i class="fa fa-trash"></i> Excluir</a>
                                <a href="{{route('painel.veiculos.show', $usuario->id)}}" class="btn btn-primary btn-sm" title="Ver Veículos"><i class="fa fa-eye"></i> Veículos</a>
                                <a href="{{route('painel.usuarios.edit', $usuario->id)}}" class="btn btn-success btn-sm" title="Editar Usuário"><i class="fa fa-edit"></i> Editar</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhum usuário encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="py-12">
        {{$usuarios->links()}}
    </div>
</x-painel-layout>
