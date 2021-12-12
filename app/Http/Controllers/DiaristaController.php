<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    /**
     * Lista as Diaristas
     *
     * @return void
     */
    public function index()
    {
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    /**
     * Mostra formulario de criação de novas diaristas
     *
     * @return void
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Cria diarista no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $dados = $request->except('_token');
       $dados['foto_usuario'] = $request->foto_usuario->store('public');
       $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
       $dados['cep'] = str_replace('.', '', $dados['cep']);
       $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);

       Diarista :: create($dados);
       return redirect()->route('diaristas.index');
    }

    /**
     * Mostra o formulario de edição
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        $diarista = Diarista:: findOrFail($id);

        return view('edit', [
            'diarista'=>$diarista
        ]);
    }

    /**
     * Atualiza diarista no banco de dados
     * @param integer $id
     * @param Request $request
     * @return void
     */
    public function update(int $id, Request $request)
    {
        $diarista = Diarista:: findOrFail($id);
        $dados = $request->except('_token', '_method');
        if ($request->hasFile('foto_usuario')){
            $dados['foto_usuario']=$request->foto_usuario->store('public');
        }
        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('.', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);
        $diarista->update($dados);
        return redirect()->route('diaristas.index');
    }

    /**
     * Apaga diarista no banco de dados
     *
     * @param integer $id
     * @return void
     */
    public function destroy(int $id)
    {
        $diarista = Diarista:: findOrFail($id);
        $diarista->delete();
        return redirect()->route('diaristas.index');
    }
}
