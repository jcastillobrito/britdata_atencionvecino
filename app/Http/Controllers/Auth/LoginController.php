<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);        

            
        if (Auth::attempt(['nr_rut' => $request->nr_rut,'password' => $request->password,'tp_activo'=>1])){
            $user = User::where('nr_rut','=',$request->nr_rut)->update(['last_login' => now()]);
            return redirect()->route('home');
        }
 
        return back()
        ->withErrors(['nr_rut' => trans('auth.failed')])
        ->withInput(request(['nr_rut']));
 
    }

    protected function validateLogin(Request $request)
    {

        $messages = [
            'cl_rut' => 'El formato del RUT es incorrecto.',
            'required' => 'El campo :attribute es obligatorio.',
        ];


        $this->validate($request,[
            'nr_rut'   => 'required|string|cl_rut',
            'password' => 'required|string'
        ],$messages);
 
    }
}
