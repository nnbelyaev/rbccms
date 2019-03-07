<?php

namespace App\Http\Controllers\Manage\System;

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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexAction()
    {
        echo 11111;
        exit;
        return view('manage.home');
    }

    public function index() {
        echo 22;

    }

    public function anothertestAction() {

    }
}
