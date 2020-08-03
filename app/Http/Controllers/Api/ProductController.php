<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\API\ApiError;
use Exception;

class ProductController extends Controller
{

    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        return response()->json($this->product->paginate(10));
    }

    public function show(Product $id){
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function store (Request $request) {

        try {
            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'created_at' => now()
            ];

            $this->product->create($data);

            return response()->json(['msg' => 'Product created sucess'], 201);

        } catch (\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error created product', 203));
        }
    }

    public function update (Request $request, $id) {

        try {
            $product = $this->product->find($id);

            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description')
            ];

            $this->product->update($data);

            return response()->json(['msg' => 'Product updated sucess'], 201);

        } catch (\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in product update', 1011));
        }
    }

    public function delete(Product $id)
    {
        try{
            $id->delete();

            return response()->json(['data' => ['msg' => 'Product '. $id->name . 'deleted sucess!']], 200);
        }catch(\Exception $e){

            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in delete product', 203));
        }
    }
}
