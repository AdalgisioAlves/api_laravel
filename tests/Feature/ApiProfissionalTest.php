<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TestApiProfissional extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_api_profissional_sucesso()
    {
        $response = $this->getJson('api/profissional/get');
        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
                $json->has('status')
                ->etc()
        );
    }

    public function test_post_api_profissional_sucesso()
    {
        $data = [
                "nome" => "Teste " .rand(),
                "crm" => rand(),
                "telefone" => "71993868315",
                "especialidades" => [1,2,4]
        ];
        $response = $this->postJson('api/profissional/post',$data);
        $response->assertStatus(200)
            ->assertJson(['status' => 1]);

    }
    public function test_post_api_profissional_fail()
    {
        $data = [
                "crm" => "5201528780",
                "telefone" => "71993868315",
                "especialidades" => [1,2,4]
        ];
        $response = $this->postJson('api/profissional/post',$data);
        $response->assertStatus(200)
            ->assertJson(['status' => 0]);

    }

    public function test_put_api_profissional_sucesso()
    {
        $data = [
            "nome" => "Teste " .rand(),
            "crm" => rand(),
            "telefone" => "71993868315",
            "especialidades" => [1,2,4]
        ];
        $response = $this->putJson('api/profissional/put/4',$data);
        $response->assertStatus(200)
            ->assertJson(['status' => 1]);

    }
}
