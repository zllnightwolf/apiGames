<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class JogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dadosJogos = Jogos::all();

         return 'Jogos encontrados:' .$dadosJogos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dadosJogos = $request->all();
        $validador = Validator::make($dadosJogos,[

            'titulo' => 'required',
            'categoria' => 'required'
        ]);

        if($validador->fails()){
            return 'Dados incompletos' .$validador->errors(true). 500;
        }

        $RegistrosJogos = Jogos::create($dadosJogos);

        if($RegistrosJogos){
            return 'Dados cadastrado com sucesso';

        }else{
            return 'Dados não cadastrado no banco de dados';
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
        $dadosJogos = Jogos::find($id);

        if($dadosJogos){
            return 'jogo encontrado:'.$dadosJogos.response()->json([],
            Response::HTTP_NO_CONTENT);

        }else{
            return 'Jogo não encontrado'.response()->json([],
            Response::HTTP_NO_CONTENT);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dadosJogos = $request->all();

        $valida = validator::make($dadosJogos,[
            'titulo' => 'required',
            'categoria'=> 'required'
        ]);

        if($valida->fails()){
            return "Erro validação!".$valida->$erros().true. 500;

        }
        $dadosJogosBanco = Jogos::find($id);
        $dadosJogosBanco->titulo = $dadosJogos['titulo'];
        $dadosJogosBanco->categoria = $dadosJogos['categoria'];

        $enviarJogos = $dadosJogosBanco->save();

        if($enviarJogos){
            return 'O jogo foi alterado com sucesso.'.response()->json([],
            Response::HTTP_NO_CONTENT);

        }else{
            return 'O jogo não foi alterado.'.response()->json([],
            Response::HTTP_NO_CONTENT);
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
        $dadosJogos = Jogos::find($id);
        if($dadosJogos){
            $dadosJogos->delete();
            return 'O Jogo foi deletado com sucesso'.$dadosJogos.response()->json([],
            Response::HTTP_NO_CONTENT); 
        }else{
            return 'O Jogo não foi deletado com sucesso'.$dadosJogos.response()->json([],
        Response::HTTP_NO_CONTENT); 
        }
        
       
        
    }
}
