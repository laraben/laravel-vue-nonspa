<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

use App\Http\Traits\Authorizable;

class RoleController extends Controller
{
    /*use Authorizable;*/

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('pages.Roles.index', compact('roles', 'permissions'));
    }


    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if( Role::create($request->only('name')) ) {
            flash('Role Added');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            flash( $role->name . ' permissions has been updated.');
        } else {
            flash()->error( 'Role with id '. $id .' note found.');
        }

        return redirect()->route('roles.index');
    }

    public function getRoles()
    {
        return response(Role::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function updateName(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->value;
        $role->save();
    }

    public function destroy(Request $request)
    {
        //dd($request);
        $role = Role::find($request->id);
        $role->delete();
    }
}
