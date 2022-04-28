<?php

namespace App\Models;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    use HasFactory;
    protected $table = 'Especialidades';
    protected $fillable = [
        'especialidade',
        'ativo'
    ];

    public function Salvar($dados)
    {

        try {

            $valida = Validator::make($dados,[
                'especialidade' => 'required|unique:especialidades|max:255',
                'ativo' => 'required'

            ]);

            if($valida->fails() == true){
                $errors = $valida->errors();
                return array(
                    'status' => 0,
                    'msg'=> 'Dados invalidos',
                    'erro' => $errors
                );
            }

            $especialidade = new Especialidades;
            $especialidade->especialidade = $dados['especialidade'];
            $especialidade->ativo = $dados['ativo'];
            $especialidade->save();


        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrad ao inserir especialidade',
                'erro' => $th->getMessage()
            );

        }
        return array(
                'status' => 1,
                'msg'=> 'Especialidade inserida com sucesso',
                'erro' => ''
        );
    }

    public function GetEspecialidade()
    {

        try {

            $especialidade = Especialidades::where('ativo','S')->get();

        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrad ao buscar especialidade',
                'erro' => $th->getMessage()
            );

        }
        return array(
                'status' => 1,
                'msg'=> '',
                'data' => $especialidade
        );
    }

    public function PutEspecialidade($dados,$id)
    {

        try {

            $valida = Validator::make($dados,[

                'especialidade' => 'required|max:255',
                'ativo' => 'required'

            ]);

            if($valida->fails() == true){
                $errors = $valida->errors();
                return array(
                    'status' => 0,
                    'msg'=> 'Dados invalidos',
                    'erro' => $errors
                );
            }

            $especialidade =  Especialidades::where('id',$id)->update(
                [
                'especialidade' => $dados['especialidade'],
                'ativo' => $dados['ativo']
                ]
            );

            return array(
                'status' => 1,
                'msg'=> 'Especialidade atualizada',
                'erro' => ''
            );


        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro encontrad ao inserir especialidade',
                'erro' => $th->getMessage()
            );

        }

    }
}
