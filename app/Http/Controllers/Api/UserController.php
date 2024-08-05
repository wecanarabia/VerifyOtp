<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
      use ResponseTrait;
    public function __construct()
    {
        $this->resource = UserResource::class;
        $this->model = app(User::class);
        $this->repositry =  new UserRepository($this->model);
    }

    public function register(UserRequest $request)
    {
        try {
            $request['id'] = Str::uuid();
            $user = $this->repositry->save($request);

            return response(['status' => true,'code' => 200, 'msg' => 'success', 'data' => [
                'user' =>  UserResource::make($user),
            ]]);
        } catch (Exception $e) {
            // dd($e);
            return $this->returnError('Sorry! Failed in creating user');
        }
    }

    public function updateUser(UserRequest $request)
    {
        try {
            $user = $this->repositry->findUser(['id'=>$request->id]);
            $user = $this->repositry->update($request->except('id'), $user);
            return response(['status' => true,'code' => 200, 'msg' => 'success', 'data' => [
                'user' =>  UserResource::make($user),
            ]]);
        } catch (\Exception $e) {
            return response([
                'status' => false,
                'code' => 500,
                'msg' => 'Error processing',
                'error' => $e->getMessage() // Optionally include error details
            ], 500);
        }
    }

    public function findUser(Request $request)
    {
        try {
            $user = $this->model->where('phone','like','%' . $request->key . '%')->orWhere('email','like','%' . $request->key . '%')->first();
            return response(['status' => true,'code' => 200, 'msg' => 'success', 'data' => [
                'user' =>  UserResource::make($user),
            ]]);
        } catch (\Exception $e) {
            return response([
                'status' => false,
                'code' => 500,
                'msg' => 'Error processing',
                'error' => $e->getMessage() // Optionally include error details
            ], 500);
        }
    }
}
