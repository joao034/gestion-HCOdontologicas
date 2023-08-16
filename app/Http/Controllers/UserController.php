<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('auth.register');
    }

    //usa el metodo de auth
    public function store(Request $request){}

    public function update( Request $request, int $id )
    {
        try{
            $this->update_user_data($request, $id);
            return to_route('users.index')->with('message', 'Usuario actualizado correctamente');
        }catch(\Exception $e){
            return back()->with('error', 'Error al actualizar usuario');
        }
    }

    public function edit( int $id ){
        $user = User::find($id);
        return view('users.edit', compact(['user']));
    }

    public function destroy( int $id )
    {
        User::find($id)->delete();
        return to_route('users.index')->with('message', 'Usuario eliminado correctamente');
    }

    private function update_user_data ( Request $request, int $id )
    {
        $user = User::find($id);
        //si el password esta seteado, lo hashea
        if( isset($request->password ) )
            $user->password = bcrypt($request->password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
    }
}
