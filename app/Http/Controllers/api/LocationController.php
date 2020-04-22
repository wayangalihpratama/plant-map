<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function index(Location $locations)
    {
        return $locations->where('level', 1)->with('childrens')->paginate(10);
    }
}
