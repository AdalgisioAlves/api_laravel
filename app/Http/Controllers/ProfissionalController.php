<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Profissional;

class ProfissionalController extends Controller
{
    public function GetProfissional(Request $request, Response $response)
    {
        $profissional  = new Profissional;
        $json = $profissional->GetProfissional();
        return response()->json($json);
    }

    public function PostProfissional(Request $request, Response $response)
    {

        $salva = new Profissional;
        $json = $salva->SalvarProfissional($request->all());
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
