<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\API\ApiError;
use App\Demanded;
use App\Product;
use App\User;

class DemandedController extends Controller
{

    private $demand;
    private $product;
    private $user;

    public function __construct(Demanded $demand, Product $product, User $user){
        $this->demanded = $demand;
        $this->product = $product;
        $this->user = $user;
    }

    public function index() {
        return response()->json($this->demanded->paginate(10));
    }

    public function show(Demanded $id){
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function store (Request $request) {

        try{
             $request->validate([
                'products_ids.id' => 'required',
                'user_id' => 'required',
            ]);

            $product = $this->product->find($request->input('products_ids.id'));
            $user = $this->user->find($request->input('user_id'));

            $data = [
                'products_ids' => $product->id,
                'user_id' => $user->id,
                'status' => 'PENDENTE',
                'created_at' => now()
            ];
            $this->demanded->create($data);

            return response()->json(['msg' => 'Request created sucess'], 201);
        } catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error create request update', 1011));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'status' => 'required|in:PENDENTE,EM_ANDAMENTO,EM_ENTREGA,ENTREGUE,FINALIZADO,CANCELADO'
            ]);

            $product = $this->product->find($request->input('products_ids.id'));
            $user = $this->user->find($request->input('user_id'));
            $demand = $this->demanded->find($id);

            $data = [
                'products_ids' => $product->id,
                'status' => $request->input('status'),
                'updated_at' => now()
            ];

            if($user->id != $demand->user_id)
            {
                return response()->json(['msg' => 'user difference'], 203);
            }

            $this->demanded->update($data);

            return response()->json(['msg' => 'Request updated sucess'], 202);

        } catch (\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in request update', 203));
        }
    }


    public function cancel($id){
        try{
            $validatedData = $request->validate([
                'user_id' => 'required'
            ]);

            $user = $this->user->find($request->input('user_id'));

            $data = [
                'status' => 'CANCELADO'
            ];

            $this->demanded->update($data);

            return response()->json(['msg' => 'Request canceled sucess'], 202);
        } catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in request update', 203));
        }
    }

}
