<?php

namespace App\Http\Controllers;

use App\Services\RasService;
use EpicKitty\Ras\ApiException;
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

    /**
     * @throws ApiException
     */
    public function profileDelete(Request $request)
    {
        $ras = new RasService();
        $ras->deleteUser(auth()->user()->name);

        auth()->user()->delete();
    }

    public function profileSessions()
    {
        $ras = new RasService(true);
        $sessions = $ras->getSessions();
    }
}
