<?php

namespace App\Http\Controllers;

use App\Http\Requests\VeiculoFormRequest;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.veiculos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculoFormRequest $request)
    {
        $regex = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';

        if (preg_match($regex, $request->placa) !== 1) {// placa inválida
            return response()->json([
                'status' => false,
                'msg' => 'Digite uma placa válida!'
            ],Response::HTTP_OK);
        }

        $veiculo = [
            'placa' => $request->placa,
            'modelo' => $request->modelo,
            'uri' => Str::slug($request->modelo, '-'),
            'cor' => $request->cor,
            'tipo' => $request->tipo,
        ];

        $usuario = auth()->user();
        if($usuario->perfil === 'usuario'){
            $salvo = $usuario->veiculos()->create($veiculo);
        }else{
            $salvo = Veiculo::create($veiculo);
        }

        if($salvo){//Se os dados forem salvos retorna json com código 200

            if($request->file('fotos')){
                foreach($request->file('fotos') as $key => $foto){
                    $extensao = '.'.$foto->getClientOriginalExtension();
                    $upload = $foto->storeAs($usuario->uri.'/veiculos/',$salvo->uri.$key.$extensao,'public');

                    if($upload){
                        $salvo->fotos()->create([
                            'url' => $upload
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => true,
                'url' => ($usuario->perfil === 'usuario' ? route('painel.index') : '')
            ],Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if($usuario){
            $veiculos = $usuario->veiculos()->with('fotos')->get();
            return view('dashboard.veiculos.list', compact('usuario', 'veiculos'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = auth()->user();
        if($usuario->perfil === 'usuario'){
            $veiculo = $usuario->veiculos()->find($id);
        }else{
            $veiculo = Veiculo::find($id);
        }
        return view('dashboard.veiculos.form', compact('veiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VeiculoFormRequest $request, $id)
    {
        $regex = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';

        if (preg_match($regex, $request->placa) !== 1) {// placa inválida
            return response()->json([
                'status' => false,
                'msg' => 'Digite uma placa válida!'
            ],Response::HTTP_OK);
        }

        $veiculo = Veiculo::find($id);

        if($veiculo){
            $veiculo->placa = $request->placa;
            $veiculo->modelo = $request->modelo;
            $veiculo->uri = Str::slug($request->modelo, '-');
            $veiculo->cor = $request->cor;
            $veiculo->tipo = $request->tipo;
    
            $salvo = $veiculo->save();
    
            if($salvo){//Se os dados forem salvos retorna json com código 200    
                if($request->file('fotos')){
                    foreach($request->file('fotos') as $key => $foto){
                        $extensao = '.'.$foto->getClientOriginalExtension();
                        $upload = $foto->storeAs('veiculos/'.$veiculo->uri,$veiculo->uri.$key.time().$extensao,'public');
    
                        if($upload){
                            $veiculo->fotos()->create([
                                'url' => $upload
                            ]);
                        }
                    }
                }
    
                return response()->json([
                    'status' => true
                ],Response::HTTP_OK);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::with('fotos')->find($id);

        if($veiculo){
            $fotos = $veiculo->fotos()->get();
            if($fotos->first()){
                foreach($fotos as $foto){
                    if(Storage::disk('public')->exists($foto->url)):
                        Storage::delete($foto->url);
                    endif;
                }
            }
            $excluido = $veiculo->delete();
            if($excluido){
                return response()->json([
                    'status' => true
                ],Response::HTTP_OK);
            }
        }
    }
}
