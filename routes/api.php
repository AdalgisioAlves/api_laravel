<?php
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/',[Controller::class,'home']);

Route::group(['prefix' => 'profissional'], function () {
    Route::get('/get', [ProfissionalController::class,'GetProfissional'])->name('profissional.get'); //Listar
    Route::post('/post', [ProfissionalController::class,'PostProfissional'])->name('profissional.post'); //Criar
    Route::put('/put/{id}', [ProfissionalController::class,'PutProfissional'])->name('profissional.put'); //Atualizar
    Route::delete('/delete/{id}', [ProfissionalController::class,'DeleteProfissional'])->name('profissional.delete'); //Deletar
});

Route::group(['prefix' => 'config'], function () {
    Route::get('/especialidade', [ConfigController::class,'getEspecialidade'])->name('config.get'); //Listar
    Route::post('/especialidade', [ConfigController::class,'postEspecialidade'])->name('config.post'); //Criar
    Route::put('/especialidade/{id}', [ConfigController::class,'putEspecialidade'])->name('config.put'); //Atualizar
    Route::delete('especialidade/{id}', [ConfigController::class,'deletEspecialidade'])->name('config.delete'); //Deletar
});