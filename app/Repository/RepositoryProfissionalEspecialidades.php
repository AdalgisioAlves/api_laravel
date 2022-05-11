<?php

namespace App\Repository;

use App\Models\ProfissionalEspecialidades;

class RepositoryProfissionalEspecialidades
{

    protected $model;
    public function __construct(ProfissionalEspecialidades $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {

        if (count($data) ==  0) {

            return array(
                'status' => 0,
                'msg' => 'Dados invalidos',
                'erro' => 'Favor informar Id do Profissional e Id da Especialidade'
            );
        }

        try {

            foreach ($data as $key => $value) {
                $salvar = new $this->model();
                $salvar->profissional_id = $value[0];
                $salvar->especialidade_id = $value[1];
                $salvar->save();
            }
            return array(
                'status' => 1,
                'msg' => 'Dados inseridos com Sucesso',
                'erro' => ''
            );
        } catch (\Throwable $th) {
            return array(
                'status' => 0,
                'msg' => 'Erro ao inserir especialidade profissional',
                'erro' => $th->getMessage()
            );
        }
    }
}
