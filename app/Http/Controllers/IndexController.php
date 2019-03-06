<?php

namespace App\Http\Controllers;

use App\Publication;

class IndexController extends Controller
{
    public function index()
    {
        return app()->getLocale();
    }
}

