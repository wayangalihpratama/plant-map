<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\CarbonHistory;
use Illuminate\Support\Collection;

class AreaController extends Controller
{
    public function index(Area $area, CarbonHistory $carbonHistory)
    {
        return $area->with('areaTrees')->with('areaTrees.tree')->paginate(50);
    }
}
