<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show dashboard login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('dashboard.login');
    }

    /**
     * Show dashboard home.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('dashboard.home');
    }
}
