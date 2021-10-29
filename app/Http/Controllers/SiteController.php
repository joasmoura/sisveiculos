<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    #Carrega página inicial do site
    #Verifica se existe usuário logado e se estiver carrega veículos cadastrados
    public function index(){
        if(auth()->check()){
            $veiculos = Veiculo::with('usuario')->paginate(15);
            return view('index', compact('veiculos'));
        }
        return view('index');
    }

    #Página de detalhes do veículo
    public function veiculo($uriusuario, $uriveiculo){
        if(!Auth()->check()){
            return redirect()->route('index');
        }
        $usuario = User::where('uri', $uriusuario)->first();
        if($usuario){
            $veiculo = $usuario->veiculos()->where('uri', $uriveiculo)->first();
            if($veiculo){
                return view('veiculo', compact('veiculo', 'usuario'));
            }else{
                return redirect()->route('index');
            }
        }else{
            return redirect()->route('index');
        }        
    }

    #Página para listagem dos veículos de um usuário
    public function usuario($uri){
        if(!auth()->check()){
            return redirect()->route('index');
        }
        $usuario = User::with('veiculos')->where('uri', $uri)->first();

        if($usuario){
            return view('dashboard.usuario', compact('usuario'));
        }else{
            return redirect()->route('index');
        }
    }

}
