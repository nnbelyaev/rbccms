<?php

namespace App\Http\Controllers\Manage\System;

use App\Datagrid\Datagrid;
use App\Http\Controllers\Manage\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getDatagrid()
    {
        $datagrid = new Datagrid('dgUser', with(new User())->getTable(),
            [
                'name' => ['width' => '250px'],
                'email' => ['width' => '250px'],
                'roles' => [
                    'sql_expr' => '1',
                    'relation' => 'belongsToMany',
                    'type' => 'select',
                    'multiOptions' => Role::all()->pluck('name', 'id')
                ],

            ],
            ['sort_column' => 'name', 'sort_order' => 'asc']
        );
        return $datagrid;
    }

    public function index(Request $request)
    {
        $datagrid = $this->getDatagrid();
        $dgId = $datagrid->getId();

        if (($dgConditions =  $request->get($dgId))) {
            $request->session()->put($dgId.'_nav', $datagrid->setConditions($dgConditions)->getConditions());
        } else {
            $datagrid->setConditions($request->session()->get($dgId.'_nav'));
        }
        return view('manage.system.user.indexdatagrid', [
            'datagrid' => $datagrid,
            'dgToolbar' => $this->datagridToolbar()
        ]);
        /*
        $users = User::paginate(15);
        return view('manage.system.user.index', compact('users'));
        */
    }

    public function create() {
        $roles = Role::all();
        return view('manage.system.user.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required','min:3','max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:32'],
            'role' => ['required'],
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        foreach ($request->get('role') as $role_id) {
            $user->roles()->save(Role::find($role_id));
        }

        return redirect(route('manage.system.user.index'));
    }

    public function edit(User $user) {
        return view('manage.system.user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required','min:3','max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'min:6', 'max:32'],
            'role' => ['required'],
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        $user->roles()->sync(Role::all()->whereIn('id', $request->get('role')));

        return redirect(route('manage.system.user.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('manage.system.user.index'));
    }
}
