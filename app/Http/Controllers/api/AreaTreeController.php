<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AreaTree;

class AreaTreeController extends Controller
{
    public function index(AreaTree $areaTrees)
    {
        return $areaTrees->paginate(100);
    }
}
