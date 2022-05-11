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

}
