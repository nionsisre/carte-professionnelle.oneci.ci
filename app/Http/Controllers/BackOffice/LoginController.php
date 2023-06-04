<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
//        return view('login');
        return view('auth');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $name = $request->login;
        // recuperation dans la bd
        $users = User::where('login',$name)->get();
        //dd($users);
        $mdp = $request->password;
        $pass = $this->signature($mdp);
        //dd($pass);
        // verification des donnees
        foreach ($users as $user){
            if ($user && $user->password == $pass){
                Auth::login($user);
                return redirect()->route("admin_home");
            }
        }
        return redirect()->route("login")->with("error", "Identifiant ou Password incorrect");

    }


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function signature($user_password)
    {
        return md5(sha1("\$@lty".$user_password."\$@lt"));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route("login");
    }

}
