<?php

namespace App\Http\Controllers\dash;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MyMessageController extends Controller
{
    public function __construct()
    {
        $this->model = app(Message::class);
        $this->repositry =  new Repository($this->model);
    }


    public function recieveMessages(Request $request)
    {
        Log::info('data',$request->all());
        $data =  $this->repositry->save($request->only(['from','body']));
        return response("Succesfully", 200)->header('Content-Type', 'text/xml');
    }
}
