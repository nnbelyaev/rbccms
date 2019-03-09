<?php

namespace App\Http\Controllers\Manage\System;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::paginate(15);
        return view('manage.system.group.index', compact('roles'));
    }

    public function create() {
        return view('manage.system.group.create');
    }
}
