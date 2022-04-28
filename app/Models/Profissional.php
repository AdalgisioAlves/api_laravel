<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfissionalEspecialidades;
use Illuminate\Support\Facades\DB;

class Profissional extends Model
{
    use HasFactory;
    protected $table = 'profissionais';
    protected $fillable = [
        'nome',
        'crm',
        'telefone'
    ];

    public function SalvarProfissional($dados)
    {

        try {

            $valida = Validator::make($dados,[
                'nome' => 'required|max:255',
                'crm' => 'required|unique:profissionais',
                'telefone' => 'required',
                'especialidades'=> 'required'
            ]);

            if($valida->fails() == true){
                $errors = $valida->errors();
                return array(
                    'status' => 0,
                    'msg'=> 'Dados invalidos',
                    'erro' => $errors
                );
            }

            $Profissional = new Profissional;
            $Profissional->nome = $dados['nome'];
            $Profissional->crm = $dados['crm'];
            $Profissional->telefone = $dados['telefone'];
            $Profissional->save();

            $especialidade = new ProfissionalEspecialidades;
            $salvar = $especialidade->PostEspecialidadesProfissional($dados['especialidades'],$Profissional->id);
            if($salvar['status'] == 0)
            {
                $this->DeleteProfissional($Profissional->id);
                return array(
                    'status' => 0,
                    'msg'=> 'Erro encontrado',
                    'erro' => $salvar['erro']
                );
            }
            return array(
                'status' => 1,
                'msg'=> 'Profissional inserido(a) com sucesso',
                'erro' => ''
            );

        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrado ao inserir Profissional',
                'erro' => $th->getMessage()
            );

        }

    }

    public function GetProfissional()
    {

        try {
            $json = [];
            $Profissional = DB::table('profissionais')
                ->select('profissionais.id','profissionais.nome', 'profissionais.crm','profissionais.telefone')
                ->get()
                ->toArray();

            foreach ($Profissional as $key => $value) {

                $especialidades = DB::table('profissional_especialidades')
                    ->select('profissional_especialidades.id','especialidades.especialidade')
                    ->join('especialidades','especialidades.id','=','profissional_especialidades.especialidade_id')
                    ->where('profissional_especialidades.profissional_id','=', 6)
                    ->get()->toArray();

                $json[$key] = array(
                    'id' => $value->id,
                    'nome' => $value->nome,
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

    public function PutProfissional($dados,$id)
    {

        try {

            $valida = Validator::make($dados,[
                'nome' => 'required|max:255',
                'crm' => 'required',
                'telefone' => 'required'
            ]);

            if($valida->fails() == true){
                $errors = $valida->errors();
                return array(
                    'status' => 0,
                    'msg'=> 'Dados invalidos',
                    'erro' => $errors
                );
            }

            $Profissional =  Profissional::where('id',$id)->update(
                [
                'nome' => $dados['nome'],
                'crm' => $dados['crm'],
                'telefone' => $dados['telefone'],
                ]
            );

            return array(
                'status' => 1,
                'msg'=> 'Profissional atualizado com suceso',
                'erro' => ''
            );


        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrado ao inserir Profissional',
                'erro' => $th->getMessage()
            );

        }

    }

    public function DeleteProfissional($id)
    {

        try {
            if(!$id){
                return array(
                    'status' => 0,
                    'msg'=> 'Erro encontrado',
                    'erro' => 'Id é obrigatório'
                );
            }
            ProfissionalEspecialidades::where('id', $id)->delete();
            if(Profissional::where('id', $id)->delete()){

                return array(
                    'status' => 1,
                    'msg'=> 'Profissional deletado com sucesso',
                    'erro' => ''
                );
            }

        } catch (\Throwable $th) {

                return array(
                    'status' => 0,
                    'msg'=> 'Erro encontrado',
                    'erro' => $th->getMessage()
                );

        }
    }
}
