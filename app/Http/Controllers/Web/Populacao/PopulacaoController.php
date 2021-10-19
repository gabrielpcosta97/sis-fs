<?php

namespace App\Http\Controllers\Web\Populacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Populacao;

class PopulacaoController extends Controller
{
    //

    private $populacao;

    function __construct(Populacao $populacao)
    {

        $this->middleware("autenticacao")->except('listar');

        $this->populacao = $populacao;
    }

    public function listar()
    {

        return response()->json(['dados' => $this->populacao->all()], 200);
    }

    public function inserir(Request $request)
    {

        $populacao = $this->populacao;

        $populacao->topico = $request->topico;
        $populacao->valor = $request->valor;

        $populacao->save();

        return response()->json(['dados' => $populacao->first()], 200);

    }

    public function recuperar(Request $request, $id)
    {

        $populacao = $this->populacao->where('id', $id)->first();

        return response()->json(['dados' => $populacao], 200);
    }

    public function alterar(Request $request, $id)
    {

        $populacao = $this->populacao->find($id);

        $populacao->topico = $request->topico;
        $populacao->valor = $request->valor;

        $populacao->save();

        return response()->json(['dados' => $populacao], 200);
    }

    public function excluir(Request $request, $id)
    {

        $populacao = $this->populacao->where('id', $id);
        $populacao->delete();

        return response()->json(['dados' => $populacao->get()], 200);    
    }
}
