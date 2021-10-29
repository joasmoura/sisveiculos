<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function sair(){
        Auth::logout();
        return redirect()->route('login');
    }
}
