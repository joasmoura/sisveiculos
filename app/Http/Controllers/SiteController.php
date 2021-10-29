<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        if(auth()->check()){
            $veiculos = Veiculo::with('usuario')->paginate(15);
            return view('index', compact('veiculos'));
        }
        return view('index');
    }

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
