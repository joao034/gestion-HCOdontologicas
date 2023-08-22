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
        //arrange
        $user = User::factory()->create()->toArray();

        //act
        $response = $this->post('/users', $user);

        //assert
        $this->assertDatabaseHas('users', $user);
        $response->assertStatus(302);
    }

    public function test_update_user(){
        //arrange
        $user = User::factory()->create();

        //act
        $response = $this->put('users/'.$user->id, [
            'name' => 'Juan',
        ]);

        //assert
        $this->assertDatabaseHas('users', $user->toArray());
        $response->assertStatus(302); //redireccion
    }

    public function test_delete_user(){
        //arrange
        $user = User::factory()->create();

        //act
        $response = $this->delete('users/'.$user->id);

        //assert
        $response->assertStatus(302); //redireccion
    }

}
