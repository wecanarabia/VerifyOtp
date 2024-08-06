<?php

namespace App\Http\Controllers\dash;

use App\Models\Otp;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;

class OtpController extends Controller
{
    protected $view = 'dash.otps.';
    public function __construct() {
        $this->model = app(Otp::class);
        $this->repository = new Repository($this->model);
    }

    public function index(Request $request)
    {
        $data = $this->model->with('subscription')->whereBelongsTo('subscription',function($q){
            $q->where(['user_id'=>auth()->user()->id]);
        })->when(isset($request['date'])&&$request['date']!=null, function ($q) use ($request){
            return $q->whereDate('created_at',$request['date']);
        })->limit(1000)->latest()->get();
        return view($this->view . 'index', compact('data'));
    }
}
