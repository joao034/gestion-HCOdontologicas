<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\TipoDocumento;
use App\Models\TipoNacionalidad;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role.admin');
    }

    private function validate_odontologo_data()
    {
        return [
            'tipo_nacionalidad_id' => 'required|integer',
            'tipo_documento_id' => 'required|integer',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string',
            'sexo' => 'required|string|max:255',
            'celular' => 'required|string|min:10|max:10',
            'especialidades' => 'required|array|min:1',
        ];
    }

    private function validate_user_data()
    {
        return [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,odontologo|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function index()
    {
        $users = User::all();
        $users = $users->sortBy('name');
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        $especialidades = Especialidad::query()->orderBy('nombre')->get();
        return view('auth.register', compact(['especialidades', 'tipos_documento', 'tipos_nacionalidad']));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $this->store_update_user_data($request, $user);
            if ($request->role === 'odontologo') {
                $odontologo = new Odontologo();
                $this->store_update_odontologo($request, $user, $odontologo);
            }
            DB::commit();
            return to_route('users.index')->with('message', 'Usuario tipo' . $request->role . ' creado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al crear el usuario ' . $e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $this->update_user_data($request, $user);
            return to_route('users.index')->with('message', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al actualizar usuario. ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        $especialidades = Especialidad::query()->orderBy('nombre')->get();
        return view('users.edit', compact(['user', 'especialidades', 'tipos_documento', 'tipos_nacionalidad']));
    }

    private function store_update_user_data(Request $request, User $user)
    {
        try {
            $this->validate($request, $this->validate_user_data());
            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al crear el usuario. ' . $e->getMessage());
        }
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
            $this->store_update_odontologo($request, $user);
        $user->save();
    }

    private function store_update_odontologo(Request $request, User $user)
    {
        $this->validate($request, $this->validate_odontologo_data());
        $user->odontologo->tipo_nacionalidad_id = $request->tipo_nacionalidad_id;
        $user->odontologo->tipo_documento_id = $request->tipo_documento_id;
        $user->odontologo->user_id = $user->id;
        $user->odontologo->nombres = $request->nombres;
        $user->odontologo->apellidos = $request->apellidos;
        $user->odontologo->cedula = $request->cedula;
        $user->odontologo->sexo = $request->sexo;
        $user->odontologo->celular = $request->celular;
        $user->odontologo->save();
        $this->almacenarEspecialidadesSeleccionadas($user->odontologo, $request);
    }

    private function almacenarEspecialidadesSeleccionadas(Odontologo $odontologo, Request $request)
    {
        $odontologo->especialidades()->sync($request->especialidades);
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
}
