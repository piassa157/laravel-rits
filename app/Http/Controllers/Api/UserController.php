<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\API\ApiError;
use App\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index() {
        return response()->json($this->user->paginate(50));
    }

    public function show(User $id) {
        $data = ['data' => $id];

        return response()->json($data);
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'nome' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);

            $data = [
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'created_at' => now()
            ];

            $this->user->create($data);

            return response()->json(['msg' => 'User created sucess'], 201);
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in create user', 1011));
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'nome' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'address' => 'nullable'
            ]);

            $this->user->find($id);

            $data = [
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address')
            ];

            user::find($id)->update($data);

            return response()->json(['msg' => 'User update sucess'], 202);
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in user update', 203));
        }
    }

    public function delete($id){
        try{
            $data = [
                'deleted_at' => now()
            ];

            user::find($id)->update($data);

            return response()->json(['msg' => 'User deleted sucess'], 202);
        } catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(), 203));
            }

            return response()->json(ApiError::errorMsg('Error in delete user', 203));
        }
    }
}
