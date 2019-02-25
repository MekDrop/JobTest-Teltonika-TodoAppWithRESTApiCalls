<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\Guard;

class FrontendController extends Controller
{

    /**
     * Get change password view
     *
     * @param string $chash
     * @param Guard $auth
     *
     * @return \Illuminate\Http\RedirectResponse|View|\Laravel\Lumen\Http\Redirector
     */
    public function getChangePasswordView(string $chash, Guard $auth) {
        $user = User::withCHash($chash);
        $initialData = [];

        if ($user instanceof User) {
            $initialData['jwt_key'] = $auth->login($user);

            $user->chash = null;
            $user->save();
        } else {
            if ($auth->check()) {
                $auth->logout();
            }

            $initialData['jwt_key'] = null;
            $initialData['error'] = 'Can\'t reset password hash is expired (one password change link can be used only for one time) or is just mistyped.';
        }
        return view('layouts/default', compact('initialData'));
    }

    /**
     * Gets default view
     *
     * @param Guard $auth
     *
     * @return View
     */
    public function getDefaultView(Guard $auth): View {
        return view('layouts/default', [
            'initialData' => [
                'jwt_key' => ($auth->check()) ? auth()->refresh() : null
            ]
        ]);
    }
}
