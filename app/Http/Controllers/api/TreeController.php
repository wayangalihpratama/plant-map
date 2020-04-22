<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tree;

class TreeController extends Controller
{
    public function index(Tree $trees)
    {
        return $trees->paginate(50);
    }
}
