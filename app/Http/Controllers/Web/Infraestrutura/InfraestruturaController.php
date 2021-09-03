<?php

namespace App\Http\Controllers\Web\Infraestrutura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Andar;
use App\Models\Infraestrutura;

class InfraestruturaController extends Controller
{
    //

    private $infraestrutura;

    public function __construct(Infraestrutura $infraestrutura)
    {

        $this->middleware('autenticacao')->except('listar');
        $this->infraestrutura = $infraestrutura;

    }

    public function index(Request $request)
    {

        return view("infraestrutura.infraestrutura", ['andares' => Andar::all()]);
    }

    public function listar(Request $request)
    {

        return response()->json(['dados' => $this->infraestrutura->with('andar')->get()], 200);

    }

    public function inserir(Request $request)
    {

        try {
            DB::beginTransaction();

            $infraestrutura = $this->infraestrutura;

            $infraestrutura->id_andar = $request->andar;
            $infraestrutura->departamento = $request->departamento;
            $infraestrutura->nome_ambiente = $request->nome_ambiente;
            $infraestrutura->uso_principal = $request->uso_principal;
            $infraestrutura->ocupacao_maxima = $request->ocupacao_maxima;
            $infraestrutura->area = $request->area;
            $infraestrutura->epi = $request->epi;
            $infraestrutura->insumos_solicitados = $request->insumos_solicitados;
            $infraestrutura->insumos_recebidos = $request->insumos_recebidos;
            $infraestrutura->saidas_ar = $request->saidas_ar;
            $infraestrutura->classificacao = $request->classificacao;
            $infraestrutura->latitude = $request->latitude;
            $infraestrutura->longitude = $request->longitude;

            $infraestrutura->save();

            DB::commit();

            return response()->json(['dados' => $infraestrutura->first()], 200);
            
        } catch (Exception $e) {

            DB::rollBack();

            report($e->getMessage());
            
        }

    }

    public function excluir(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $infraestrutura = Infraestrutura::where('id', $id);

            $infraestrutura->delete();

            DB::commit();

            return response()->json($infraestrutura->get(), 200);
            
        } catch (Exception $e) {
            

        }
    }
}
