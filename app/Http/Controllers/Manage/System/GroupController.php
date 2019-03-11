<?php

namespace App\Http\Controllers\Manage\System;

use App\Http\Controllers\Manage\Controller;
use App\Role;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(15);
        return view('manage.system.group.index', compact('roles'));
    }

    public function create() {
        return view('manage.system.group.create');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'name' => ['required','min:3','max:100'],
            'permission' => ['required']
        ]);
        Role::create($attributes)->addPermissions($request->get('permission'));
        return redirect(route('manage.system.group.index'));
    }

    public function edit(Role $group) {
        if ($group->id == 1) abort(403, 'Adminstrators Role cant be edit');

        return view('manage.system.group.edit', [
            'group' => $group,
            'permissions' => $group->permissions()->get()
        ]);
    }

    public function update(Request $request, Role $group) {
        if ($group->id == 1) abort(403, 'Adminstrators Role cant be edit');

        $request->validate([
            'name' => ['required','min:3','max:100'],
            'permission' => ['required']
        ]);
        $group->name = $request->get('name');
        $group->label = $request->get('label');
        $group->save();

        $group->addPermissions($request->get('permission'));

        return redirect(route('manage.system.group.index'));
    }

    public function destroy(Role $group)
    {
        if ($group->id == 1) abort(403, 'Adminstrators Role cant be edit');

        $group->delete();
        return redirect(route('manage.system.group.index'));
    }
}
