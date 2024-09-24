<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Log;

class MyMessageController extends ApiController
{
    public function __construct()
    {
        $this->resource = MessageResource::class;
        $this->model = app(Message::class);
        $this->repositry =  new Repository($this->model);
    }


    public function recieveMessages(Request $request)
    {
        Log::info('data',$request->all());
        $data =  $this->repositry->save($request->only(['from','body']));
        return $this->returnData('data',  $this->resource::make($data), __('Succesfully'));
    }
}
