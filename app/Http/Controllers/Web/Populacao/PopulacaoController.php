<?php

namespace App\Http\Controllers\Web\Populacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Populacao;
use Illuminate\Support\Facades\DB;

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

    public function recuperar(Request $request, $id)
    {

        $populacao = $this->populacao->where('id', $id)->first();

        return response()->json(['dados' => $populacao], 200);
    }

    public function inserir(Request $request)
    {

        try {

            DB::beginTransaction();

            $populacao = $this->populacao;

            $populacao->topico = $request->topico;
            $populacao->valor = $request->valor;

            $populacao->save();

            DB::commit();

            return response()->json(['dados' => $populacao->first()], 200);
            
        } catch (Exception $e) {

            DB::rollBack();

            report($e);
            
        }

    }

    public function alterar(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $populacao = $this->populacao->find($id);

            $populacao->topico = $request->topico;
            $populacao->valor = $request->valor;

            $populacao->save();

            DB::commit();

            return response()->json(['dados' => $populacao], 200);
            
        } catch (Exception $e) {

            DB::rollBack();
            
            report($e);
        }

        
    }

    public function excluir(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $populacao = $this->populacao->where('id', $id);
            $populacao->delete();

            DB::commit();

            return response()->json(['dados' => $populacao->get()], 200);
                
        } catch (Exception $e) {


            DB::rollBack();
            
            report($e);
                
        }    
    }
}
