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


    public function show(Demanded $id){
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function store (Request $request) {

            $products = $request->input('products_ids');


            $data = [
                'products_ids' => $products,
                'user_id' => $request->input('user_id'),
                'status' => 'PENDENTE',
                'created_at' => now()
            ];


            $this->demanded->create($data);

            return response()->json(['msg' => 'Request created sucess'], 201);
    }

}
