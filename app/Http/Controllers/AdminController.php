<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RasService;
use EpicKitty\Ras\ApiException;

class AdminController extends Controller
{
    public $ras;
    public function __construct()
    {
        $this->ras = new RasService();
    }

    public function home()
    {
        return view('admin.home');
    }

    public function usersIndex()
    {
        return view('admin.users.index', [
            'users' => User::with('aim', 'icq')->paginate(25)
        ]);
    }

    public function usersShow(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function usersEdit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function usersUpdate(User $user)
    {
        $user->update(request()->all());
        return redirect()->route('dashboard.admin.users.edit', $user);
    }

    /**
     * @throws ApiException
     */
    public function usersDestroy(User $user)
    {
        if ($user->has_aim) {
            $this->ras->deleteUser($user->aim->name);
        }

        if ($user->has_icq) {
            $this->ras->deleteUser($user->icq->name);
        }

        $user->delete();
        return redirect()->route('dashboard.admin.users.index');
    }

    public function categoriesIndex()
    {
        return view('admin.categories.index');
    }

    public function keywordsIndex()
    {
        return view('admin.keywords.index');
    }

    public function publicRoomsIndex()
    {
        return view('admin.public-rooms.index');
    }

    public function privateRoomsIndex()
    {
        return view('admin.private-rooms.index');
    }
}
