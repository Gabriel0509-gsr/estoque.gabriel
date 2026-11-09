<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioToken;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    public function test_login_page_renders_for_get_request(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertViewIs('login_aula');
        $response->assertSee(route('login.authenticate'), false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="senha"', false);
    }

    public function test_api_login_returns_validation_errors_for_missing_credentials(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'senha']);
    }

    public function test_api_accepts_a_bearer_token_without_a_user_id_in_the_request(): void
    {
        $this->createApiTables();

        $usuario = Usuario::create([
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'senha' => 'senha-segura',
            'tipo_usuario' => 1,
        ]);

        $token = UsuarioToken::create([
            'usuario_id' => $usuario->id,
            'token' => 'token-de-teste',
            'valido_ate' => now()->addDay(),
        ]);

        $response = $this->withToken($token->token)->deleteJson('/api/logoutApi');

        $response->assertOk();
        $response->assertJson(['erro' => 'n']);
        $this->assertDatabaseMissing('usuario_token', ['id' => $token->id]);
    }

    public function test_api_registration_returns_user_information_and_token(): void
    {
        $this->createApiTables();

        $response = $this->postJson('/api/salvar_usuario', [
            'nome' => 'Nova Pessoa',
            'email' => 'nova@example.com',
            'senha' => 'senha-segura',
            'tipo_usuario' => '1',
            'cpf' => '12345678901',
            'data_nascimento' => '2000-01-01',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'usuario' => ['id', 'nome', 'email', 'tipo_usuario', 'cpf', 'data_nascimento'],
            'token',
            'erro',
        ]);
        $response->assertJsonPath('usuario.nome', 'Nova Pessoa');
        $response->assertJsonPath('usuario.email', 'nova@example.com');
        $response->assertJsonPath('erro', 'n');
        $this->assertNotEmpty($response->json('token'));
        $this->assertArrayNotHasKey('message', $response->json());
        $this->assertArrayNotHasKey('senha', $response->json('usuario'));
        $this->assertDatabaseHas('usuario_token', [
            'usuario_id' => $response->json('usuario.id'),
            'token' => $response->json('token'),
        ]);
    }

    private function createApiTables(): void
    {
        Schema::create('usuario', function (Blueprint $table): void {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->integer('tipo_usuario');
            $table->string('cpf')->nullable();
            $table->date('data_nascimento')->nullable();
        });

        Schema::create('usuario_token', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->text('token');
            $table->timestamp('valido_ate');
            $table->timestamps();
        });
    }
}
