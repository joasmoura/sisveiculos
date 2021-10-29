<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    #Página inicial do painel
    public function index(){
        return view('dashboard.index');
    }

    #Deslogando usuário
    public function sair(){
        Auth::logout();
        return redirect()->route('login');
    }
}
