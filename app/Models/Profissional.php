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
}
