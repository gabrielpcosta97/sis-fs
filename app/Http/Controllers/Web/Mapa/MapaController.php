<?php

namespace App\Http\Controllers\Web\Mapa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Andar;
use App\Models\Infraestrutura;

class MapaController extends Controller
{
    //

    public function __construct(Infraestrutura $infraestrutura)
    {

        $this->infraestrutura = $infraestrutura;

    }

    public function index(Request $request)
    {

        $andares = new Andar();

        $ret = [
            'infraestrutura' => $this->infraestrutura->get(),
            'andares' => $andares->all()
        ];

        return view("mapa.mapa", $ret);
    }

}
