<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;

use App\Http\Traits\Authorizable;

use DB;

class UsersController extends Controller
{
    /*use Authorizable;*/

    public function index() {

        $users = User::paginate();

        $roles = Role::pluck('name','id')->all();

        return view('pages.Users.index', compact('users','roles'));
    }

    public function create(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

    }

    public function edit($id)
    {
        $user = User::find($id);

        $userRole = $user->roles->pluck('id')->first();

        $roles = Role::pluck('name','id')->all();

        return view('pages.Users.edit', compact('user','roles','userRole'));

    }

    public function store(Request $request)
    {
        //dd($request);
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required']
        ])->validate();

        $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

        $user->assignRole($request['role']);


        return redirect()->route('users.index')
                        ->with('success', 'User created successfully');

    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:191'],
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8',
            'role' => ['required']
        ])->validate();

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request['password'])){
            $user->password = Hash::make($request['password']);
        }
        $user->save();

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->role);

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully');

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully');

    }

    public function getUsers()
    {
        /*$users = User::all();
        return $users;*/
        return response(User::with('roles')->get()->jsonSerialize(), Response::HTTP_OK);
    }

    public function updateName(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->value;
        $user->save();
    }

    public function updateEmail(Request $request)
    {
        $user = User::find($request->id);
        $user->email = $request->value;
        $user->save();
    }
}
