<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $view = 'dash.home';
    public function index()
    {
        return view($this->view);
    }
}
