<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login(){

        //arrange
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        //act
        $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);

        //assert
        $response->assertStatus(302);
        $response->assertRedirect('/hclinicas');

    }

    public function test_unauthenticated_user_cannot_access_moduls(){
        $response = $this->get('/hclinicas');   
        $response = $this->get('/tratamientos');   
        $response = $this->get('/odontogramas');   
        $response = $this->get('/detallesOdontogramas');   
        $response = $this->get('/odontologos');   
        $response = $this->get('/presupuestos');   
        $response = $this->get('/especialidades');   
    
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
