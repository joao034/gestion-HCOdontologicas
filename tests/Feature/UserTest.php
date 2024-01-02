<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class UserTest extends TestCase
{

    use RefreshDatabase; //para que se refresque la base de datos después de cada prueba en memoria

    public function test_get_users()
    {
        $response = $this->get('/users');
        $response->assertStatus(302);
    }

    public function test_store_user()
    {
        $user = User::factory()->create()->toArray();

        $response = $this->post('/users', $user);

        $this->assertDatabaseHas('users', $user);
        $response->assertStatus(302);
    }

    public function test_disable_user(){
        $user = User::factory()->create();

        $response = $this->put('users/'.$user->id, [
            'active' => false
        ]);

        $this->assertDatabaseHas('users', $user->toArray());
        $response->assertStatus(302); //redireccion
    }

    /* public function test_disable_user(){
        //arrange
        $user = User::factory()->create();

        //act
        $response = $this->delete('users/'.$user->id);

        //assert
        $response->assertStatus(302); //redireccion
    } */

}
