<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\RedirectService;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private RedirectService $redirectService;

    /**
     * AdminController constructor.
     * @param RedirectService $redirectService
     */
    public function __construct(RedirectService $redirectService)
    {
        $this->redirectService = $redirectService;
    }

    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getChangePassword()
    {
        /**
         * @var CanResetPassword $user
         */
        $user = Auth::user();
        $email = $user->getEmailForPasswordReset();

        /**
         * @var PasswordBroker $broker
         */
        $broker = app('auth.password.broker');
        $broker->deleteToken($user);
        $token = $broker->createToken($user);

        return redirect(route("password.reset", ['token' => $token, 'email' => $email]));
    }

    public function getRedirects()
    {
        $redirects = $this->redirectService->getRedirects();

        return view('admin.redirects', ['redirects' => $redirects]);
    }

    public function getNewRedirect()
    {
        return view('admin.editredirect');
    }

    public function getEditRedirect(int $id, Request $request)
    {
        $redirect = $this->redirectService->findRedirectById($id);

        return view('admin.editredirect', ['redirect' => $redirect, 'request' => $request]);
    }

    public function postNewRedirects(Request $request)
    {
        $input = $request->all();
        if (isset($input['uri'])) {
            $input['uri'] = ltrim($input['uri'], '/');
        }
        $validator = Validator::make(
            $input,
            [
                'uri' => 'required|alpha_num',
                'destination' => 'required|url'
            ]
        );
        if ($request->get('id')) {
            if ($validator->fails()) {
                return redirect(route('redirects.update', ['id' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }

            $this->redirectService->updateRedirect(
                (int)$request->get('id'),
                $request->get('uri'),
                $request->get('destination'),
                !empty($request->get('active'))
            );
        } else {
            if ($validator->fails()) {
                return redirect(route('redirects.create'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $this->redirectService->createRedirect(
                $request->get('uri'),
                $request->get('destination'),
                !empty($request->get('active'))
            );
        }
        return redirect(route('redirects.index'));
    }
}
