<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Demanded;

class DemandedController extends Controller
{

    private $demand;

    public function __construct(Demanded $demand){
        $this->demanded = $demand;
    }
    public function index() {
        return response()->json($this->demanded->paginate(10));
    }
}
