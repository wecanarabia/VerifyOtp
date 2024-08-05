<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\SubscriptionResource;
use App\Http\Requests\Api\SubscriptionRequest;

class SubscriptionController extends ApiController
{
    public function __construct()
    {
        $this->resource = SubscriptionResource::class;
        $this->model = app(Subscription::class);
        $this->repositry =  new Repository($this->model);
    }

     public function create(SubscriptionRequest $request)
    {
        if($this->model->where(['user_id' => auth()->user()->id,'type'=>$request['type'],'start_date'=>$request['start_date'],'start_date'=>$request['start_date']])->exists()){
            return $this->returnError( 'Already subscribed');
        }
        $request['user_id'] = auth()->user()->id;
        $subscription = $this->repositry->save($request->all());
        return $this->returnData('data',  $this->resource::make($subscription), __('Get  succesfully'));
    }

     public function edit(SubscriptionRequest $request,$id)
    {
        $subscription = $this->repositry->getByID($id);
        $subscription = $this->repositry->update($request->all(),$id);

        return $this->returnData('data',  $this->resource::make($subscription), __('Get  succesfully'));
    }
    public function mySubscriptions(){
        $id = auth()->user()->id;
        $subscription = $this->repositry->getNullConditiontion('user_id', $id);
        return $this->returnData('data',  $this->resource::collection( $subscription ), __('Get  succesfully'));
    }





}
