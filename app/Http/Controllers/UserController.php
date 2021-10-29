<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    # Lista os usuários cadastrados somente para o admin do sistema
    # Se um usuário comum acesar a rota referente a esse método ele será redirecionado para 
    # a página inicial do painel
    public function index()
    {
        $autenticado = auth()->user();

        if($autenticado->perfil === 'usuario'){
            return redirect()->route('painel.index');
        }
        $usuarios = User::where('perfil','usuario')->paginate(15);
        return view('dashboard.users.index', compact('usuarios'));
    }

    # Lista os usuários desativados somente para o admin do sistema
    # Se um usuário comum acesar a rota referente a esse método ele será redirecionado para 
    # a página inicial do painel
    public function desativados()
    {
        $autenticado = auth()->user();

        if($autenticado->perfil === 'usuario'){
            return redirect()->route('painel.index');
        }
        $usuarios = User::onlyTrashed()->where('perfil','usuario')->paginate(15);
        return view('dashboard.users.index', compact('usuarios'));
    }

    # Abre form para alter dados do usuário logado
    public function perfil(){
        return view('dashboard.users.perfil');
    }

    # Salvando dados do usuário logado
    public function salvarPerfil(UserFormRequest $request){
        $usuario = auth()->user();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if(!empty($request->password)){
            $usuario->password = Hash::make($request->password);
        }

        $salvo = $usuario->save();

        if($salvo){//Se os dados forem salvos retorna json com código 200
            return response()->json([
                'status' => true
            ],Response::HTTP_OK);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    # Abre formulário para edição do usuário
    public function edit($id)
    {
        $usuario = auth()->user();
        if($usuario->perfil === 'admin'){
            $usuario = User::find($id);
        }
        
        if($usuario){
            return view('dashboard.users.form', compact('usuario'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     # Atualizando informações do usuário
    public function update(UserFormRequest $request, $id)
    {
        $usuario = User::find($id);
        if(!$usuario){//Se o usuário não existir retorna uma mensagem de erro para o javascript
            return response()->json([
                'msg' => 'Usuário não encontrado!'
            ],Response::HTTP_NOT_FOUND);
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if(!empty($request->password)){
            $usuario->password = Hash::make($request->password);
        }
        $salvo = $usuario->Save();

        if($salvo){//Se os dados forem salvos retorna json com código 200
            return response()->json([
                'status' => true
            ],Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     # Desativando o usuário, deixando-o em um estado que não possa acessar o sistema
     # e também não lista seus veículos
     # Função orquestrada pelo SoftDelets
    public function destroy($id)
    {
        $usuario = User::with('veiculos')->find($id);

        if($usuario){
            $excluido = $usuario->delete();
            if($excluido){
                return response()->json([
                    'status' => true
                ],Response::HTTP_OK);
            }
        }
    }

    # Apagando usuário definitivamente e excluindo os veículos e respectivamente as fotos cadastradas
    public function destroy_permanente($id){
        $usuario = User::withTrashed()->with('veiculos')->find($id);

        if($usuario){
            $veiculos = $usuario->veiculos()->get();
            if($veiculos->first()){
                foreach($veiculos as $veiculo){
                    $fotos = $veiculo->fotos()->get();
                    if($fotos->first()){
                        foreach($fotos as $foto){
                            if(Storage::disk('public')->exists($foto->url)):
                                Storage::delete($foto->url);
                            endif;
                        }
                    }
                }
            }

            $excluido = $usuario->forceDelete();

            if($excluido){
                return response()->json([
                    'status' => true
                ],Response::HTTP_OK);
            }
        }
    }

    # Restaurando usuário que estava desativado pelo SoftDelets
    public function restaurar($id){
        $usuario = User::withTrashed()->find($id);

        if($usuario){
            $usuario->restore();
            return redirect()->route('painel.usuarios.index');
        }
    }
}
