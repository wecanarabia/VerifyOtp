<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct() {
        $this->user = app(User::class);
        $this->repository = new UserRepository($this->user);
    }
    protected $view = 'dash.profile';
    public function profile()
    {
        $user = $this->repository->getUser(['id'=> auth()->user()->id]);
        return view($this->view, compact('user'));
    }
}
