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
        $data = $this->repository->all();
        return view($this->view . 'index', compact('data'));
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $country = $this->repository->getByID($id);
        return view($this->view . 'show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = $this->repository->getByID($id);
        return view($this->view . 'edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, string $id)
    {
        $this->repository->update($request->all(),$id);

        return redirect()->route($this->view . 'index')
                        ->with('success', __($this->messages['updated']));
    }
}
