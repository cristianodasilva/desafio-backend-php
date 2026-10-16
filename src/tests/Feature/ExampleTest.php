<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica se a página inicial é exibida corretamente.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Cadastro de Clientes');
    }

    /**
     * Verifica se um cliente pode ser cadastrado.
     */
    public function test_a_client_can_be_created(): void
    {
        $response = $this->post(route('clients.store'), [
            'name' => 'Cliente de Teste',
            'email' => 'cliente.teste@example.com',
            'phone' => '(11) 99999-9999',
        ]);

        $response->assertRedirect(route('clients.index'));

        $this->assertDatabaseHas('clients', [
            'name' => 'Cliente de Teste',
            'email' => 'cliente.teste@example.com',
            'phone' => '(11) 99999-9999',
        ]);

        $this->assertDatabaseCount('clients', 1);
    }

    /**
     * Verifica se os dados de um cliente podem ser atualizados.
     */
    public function test_a_client_can_be_updated(): void
    {
        $client = Client::create([
            'name' => 'Cliente Original',
            'email' => 'original@example.com',
            'phone' => '(11) 98888-8888',
        ]);

        $response = $this->put(route('clients.update', $client), [
            'name' => 'Cliente Atualizado',
            'email' => 'atualizado@example.com',
            'phone' => '(11) 97777-7777',
        ]);

        $response->assertRedirect(route('clients.index'));

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Cliente Atualizado',
            'email' => 'atualizado@example.com',
            'phone' => '(11) 97777-7777',
        ]);
    }

    /**
     * Verifica se um cliente pode ser excluído.
     */
    public function test_a_client_can_be_deleted(): void
    {
        $client = Client::create([
            'name' => 'Cliente para Exclusão',
            'email' => 'exclusao@example.com',
            'phone' => '(11) 96666-6666',
        ]);

        $response = $this->delete(route('clients.destroy', $client));

        $response->assertRedirect(route('clients.index'));

        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }

    /**
     * Verifica se o cadastro rejeita campos obrigatórios ausentes.
     */
    public function test_a_client_cannot_be_created_without_required_fields(): void
    {
        $response = $this->from(route('clients.create'))
            ->post(route('clients.store'), []);

        $response->assertRedirect(route('clients.create'));
        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone',
        ]);

        $this->assertDatabaseCount('clients', 0);
    }
}