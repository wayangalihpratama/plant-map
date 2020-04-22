<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarbonHistory;

class CarbonHistoryController extends Controller
{
    public function index(CarbonHistory $carbonHistories)
    {
        return $carbonHistories->paginate(100);
    }
}
