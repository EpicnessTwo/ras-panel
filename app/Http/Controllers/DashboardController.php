<?php

namespace App\Http\Controllers;

use App\Models\Accounts\Icq;
use App\Services\RasService;
use EpicKitty\Ras\ApiException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    /**
     * @throws ApiException
     */
    public function createAim(Request $request): RedirectResponse
    {
        if (auth()->user()->has_aim) {
            return redirect()->route('dashboard.home');
        }

        $validated = $request->validate([
            'username' => 'unique:aims,name|required|regex:/^[a-zA-Z][a-zA-Z0-9\s]{3,14}$/',
            'password' => 'required|min:4|max:16',
        ]);

        $ras = new RasService();
        $ras->addUser($validated['username'], $validated['password']);

        auth()->user()->aim()->create([
            'name' => $validated['username'],
        ]);

        return redirect()->route('dashboard.home');

    }

    /**
     * @throws ApiException
     */
    public function updateAim(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required|min:4|max:16',
        ]);

        $ras = new RasService();
        $ras->updateUserPassword(auth()->user()->aim->name, $validated['password']);

        return redirect()->route('dashboard.home');
    }

    /**
     * @throws ApiException
     */
    public function deleteAim(Request $request): RedirectResponse
    {
        $ras = new RasService();
        $ras->deleteUser(auth()->user()->aim->name);

        auth()->user()->aim->delete();

        return redirect()->route('dashboard.home');
    }

    /**
     * @throws ApiException
     */
    public function createIcq(Request $request): RedirectResponse
    {
        if (auth()->user()->has_icq) {
            return redirect()->route('dashboard.home');
        }

        $validated = $request->validate([
            'password' => 'required|min:6|max:8',
        ]);

        // Generate a random ICQ number that doesn't already exist
        $icq = rand(100000, 999999);
        while (Icq::whereName($icq)->exists()) {
            $icq = rand(100000, 999999);
        }

        $ras = new RasService();
        $ras->addUser($icq, $validated['password']);

        auth()->user()->icq()->create([
            'name' => $icq,
        ]);

        return redirect()->route('dashboard.home');
    }

    /**
     * @throws ApiException
     */
    public function updateIcq(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required|min:6|max:8',
        ]);

        $ras = new RasService();
        $ras->updateUserPassword(auth()->user()->icq->name, $validated['password']);

        return redirect()->route('dashboard.home');
    }

    /**
     * @throws ApiException
     */
    public function deleteIcq(Request $request): RedirectResponse
    {
        $ras = new RasService();
        $ras->deleteUser(auth()->user()->icq->name);

        auth()->user()->icq->delete();

        return redirect()->route('dashboard.home');
    }
}
