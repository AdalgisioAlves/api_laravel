<?php


namespace App\Service;

use App\Repository\ProfissionalRepository;
use Illuminate\Support\Facades\Validator;
class ProfissionalService{

    protected $profissionalRepository;

    public function __construct(ProfissionalRepository $profissionalRepo)
    {
        $this->profissionalRepository = $profissionalRepo;
    }

    public function create(array $data)
    {

        try {

            $valida = Validator::make($data,[
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

            $profissional = $this->profissionalRepository->create($data);
            return $profissional;

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
        return $profissional = $this->profissionalRepository->getAll();
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

            $Profissional =  $this->profissionalRepository::where('id',$id)->update(
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
