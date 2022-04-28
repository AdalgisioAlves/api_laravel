<?php

namespace App\Http\Controllers;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ConfigController extends Controller
{
    public function GetEspecialidade( Response $response)
    {
        $salvar = new Especialidades;
        $teste = $salvar->GetEspecialidade();
        return response()->json($teste);
    }

    public function PostEspecialidade(Request $request, Response $response)
    {


        $salvar = new Especialidades;
        $teste = $salvar->salvar($request->all());

        return response()->json($teste);
    }

    public function PutEspecialidade(Request $request, $id)
    {

        $salvar = new Especialidades;
        $teste = $salvar->PutEspecialidade($request->all(),$id);
        return response()->json($teste);
    }

    public function DeleteEspecialidade(Request $request, Response $response)
    {
        return response()->json(["message"=> 'Bem vindo ao home']);
    }
}
