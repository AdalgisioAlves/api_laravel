<?php


namespace App\Repository;

use App\Models\Profissional;
use Illuminate\Support\Facades\DB;
class ProfissionalRepository{

    protected $model;

    public function __construct(Profissional $profissional)
    {
        $this->model = $profissional;
    }

    public function create($dados)
    {

        try {

            $Profissional = new $this->model();
            $Profissional->nome = $dados['nome'];
            $Profissional->crm = $dados['crm'];
            $Profissional->telefone = $dados['telefone'];
            $Profissional->save();

            return array(
                'status' => 1,
                'msg'=> 'Profissional Salvo',
                'erro' => null,
                'data' => ["id_profissional" => $Profissional->id]
            );

        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrado ao inserir Profissional',
                'erro' => $th->getMessage()
            );

        }

    }
    public function getAll()
    {

        try {

            $json = [];
            $dados = DB::table('profissionais')
                    ->select('id','nome','crm','telefone')
                    ->get();
            foreach ($dados as $key => $value) {

                $especialidades = DB::table('profissional_especialidades')
                    ->select('profissional_especialidades.id','especialidades.especialidade')
                    ->join('especialidades','especialidades.id','=','profissional_especialidades.especialidade_id')
                    ->where('profissional_especialidades.profissional_id','=', $value->id)
                    ->get()->toArray();

                $json[$key] = array(
                    'id' => $value->id,
                    'nome' => $value->nome,
                    'crm' => $value->crm,
                    'telefone' => $value->telefone,
                    'especialidades' => $especialidades
                );

            }
        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrad ao buscar Profissional',
                'erro' => $th->getMessage()
            );

        }
        return array(
                'status' => 1,
                'msg'=> 'OK',
                'data' => $json
        );
    }
}
