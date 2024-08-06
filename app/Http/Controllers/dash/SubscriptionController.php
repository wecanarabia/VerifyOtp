<?php

namespace App\Http\Controllers\dash;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\dash\SubscriptionRequest;

class SubscriptionController extends Controller
{
    private $view ='dash.subscriptions.';

    private $messages = [
        'updated' => 'messages.controller.SUBSCRIPTION_UPDATED',
    ];

    public function __construct() {
        $this->model = app(Subscription::class);
        $this->repository = new Repository($this->model);
    }

      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->getCondition(['user_id'=>auth()->user()->id]);
        return view($this->view . 'index', compact('data'));
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $subscription = $this->repository->getByID($id);
        if ($subscription->user_id!=auth()->user()->id) {
            return abort("404");
        }
        return view($this->view . 'show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = $this->repository->getByID($id);
        if ($subscription->user_id!=auth()->user()->id) {
            return abort("404");
        }
        return view($this->view . 'edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, string $id)
    {
        $subscription = $this->repository->getByID($id);
        if ($subscription->user_id!=auth()->user()->id) {
            return abort("404");
        }
        $this->repository->update($request->all(),$id);

        return redirect()->route($this->view . 'index')
                        ->with('success', __($this->messages['updated']));
    }
}
