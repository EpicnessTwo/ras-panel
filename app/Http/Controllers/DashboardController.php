<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function profilePost(Request $request)
    {
        dd('Not implemented');
    }
}
