<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Profissional;
use App\Service\ProfissionalService;

class ProfissionalController extends Controller
{
    protected $serviceProfissional;

    public function __construct(ProfissionalService $profissionalService)
    {
        $this->serviceProfissional = $profissionalService;

    }
    public function GetProfissional()
    {
        $profissional  = $this->serviceProfissional->getAll();
        return response()->json($profissional);
    }

    public function PostProfissional(Request $request, Response $response)
    {

        $json = $this->serviceProfissional->create($request->all());
        return response()->json($json);
    }

    public function BuscarProfissional(Request $request, Response $response)
    {

        $salva = new Profissional;
        $json = $salva->BuscarProfissional($request->all());
        return response()->json($json);
    }

    public function PutProfissional(Request $request,$id)
    {
        $salva = new Profissional;
        $json = $salva->PutProfissional($request->all(),$id);
        return response()->json($json);
    }

    public function DeleteProfissional($id)
    {
        $salva = new Profissional;
        $json = $salva->DeleteProfissional($id);
        return response()->json($json);
    }
}
