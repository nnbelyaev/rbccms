<?php

namespace App\Http\Controllers\Manage\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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

    public function test() {

    }

    public function index()
    {
        echo 1111;
        exit;

    }
}
