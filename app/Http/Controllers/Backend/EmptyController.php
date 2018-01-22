<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmptyController extends Controller
{

    public function index()
    {
        abort(404);
    }

}
