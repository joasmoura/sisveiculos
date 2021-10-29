<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $veiculos = Veiculo::with('usuario')->paginate(15);
        return view('index', compact('veiculos'));
    }

    public function veiculo($uriusuario, $uriveiculo){
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
        $usuario = User::with('veiculos')->where('uri', $uri)->first();

        if($usuario){
            return view('dashboard.usuario', compact('usuario'));
        }else{
            return redirect()->route('index');
        }
    }

}
