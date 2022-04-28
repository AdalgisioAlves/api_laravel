<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ProfissionalEspecialidades extends Model
{
    use HasFactory;
    protected $table = 'Profissional_Especialidades';
    protected $fillable = [
        'profissional_id',
        'especialidade_id'
    ];

    public function PostEspecialidadesProfissional($especialiades,$profissional_id)
    {


        if(count($especialiades) == 0 && $profissional_id == null){

            return array(
                'status' => 0,
                'msg'=> 'Dados invalidos',
                'erro' => 'Favor informar Id do Profissional e Id da Especialidade'
            );
        }


        try {

            foreach ($especialiades as $key => $value) {
                $salvar = new ProfissionalEspecialidades;
                $salvar->profissional_id = $profissional_id;
                $salvar->especialidade_id = $value;
                $salvar->save();

            }
            return array(
                'status' => 1,
                'msg'=> 'Dados inseridos com Sucesso',
                'erro' => ''
            );
        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg'=> 'Erro ao inserir especialidade profissional',
                'erro' => $th->getMessage()
            );
        }
    }
}
