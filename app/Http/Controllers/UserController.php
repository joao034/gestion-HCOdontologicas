<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use App\Models\Odontologo;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role.admin');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $especialidades = Especialidad::query()->orderBy('nombre')->get();
        return view('auth.register', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,odontologo|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if ($request->role === 'odontologo')
                $this->createOdontologo($user, $request);

            DB::commit();
            return to_route('users.index')->with('message', 'Exito');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al crear el usuario ');
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $this->update_user_data($request, $user);
            return to_route('users.index')->with('message', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al actualizar usuario' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $especialidades = Especialidad::query()->orderBy('nombre')->get();
        return view('users.edit', compact(['user', 'especialidades']));
    }

    public function destroy(int $id)
    {
        //elimina el usuario y el odontologo
        DB::beginTransaction();
        $user = User::find($id);
        $user->odontologo()->delete();
        $user->delete();
        DB::commit();
        return to_route('users.index')->with('message', 'Usuario eliminado correctamente');
    }

    private function update_user_data(Request $request, User $user)
    {
        //si el usuario ingresa un nuevo password, lo hashea
        if (isset($request->password))
            $user->password = bcrypt($request->password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;

        if ($user->role === 'odontologo')
            $this->store_update_data_odontologo($user, $request);
        $user->save();
    }

    private function store_update_data_odontologo(User $user, Request $request)
    {
        $this->validate($request, $this->validate_odontologo_data());
        $user->odontologo->nombres = $request->nombres;
        $user->odontologo->apellidos = $request->apellidos;
        $user->odontologo->cedula = $request->cedula;
        $user->odontologo->sexo = $request->sexo;
        $user->odontologo->celular = $request->celular;
        $user->odontologo->especialidad_id = $request->especialidad_id;
        $user->odontologo->user_id = $user->id;
        $user->odontologo->save();
    }

    private function validate_odontologo_data()
    {
        return [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|min:10|max:10|validar_cedula',
            'sexo' => 'required|string|max:255',
            'celular' => 'required|string|min:10|max:10',
            'especialidad_id' => 'required|integer',
        ];
    }

    private function createOdontologo(User $user, Request $request)
    {
        $this->validate($request, $this->validate_odontologo_data());
        Odontologo::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'cedula' => $request->cedula,
            'sexo' => $request->sexo,
            'celular' => $request->celular,
            'especialidad_id' => $request->especialidad_id,
            'user_id' => $user->id,
        ]);
    }
}
