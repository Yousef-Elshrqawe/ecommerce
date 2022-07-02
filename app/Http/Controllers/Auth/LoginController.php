<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    use AuthenticatesUsers {

        logout as protected originalLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        return 'username';
    }

    public function redirectTo()
    {
        //لو  allowed_route الموجوده في   جدول roles مش فاضيه دخلو ع صفحه admin

        if (auth()->user()->roles()->first()->allowed_route != '')
        {
            return $this->redirectTo = auth()->user()->roles()->first()->allowed_route . '/index';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        $response = $this->originalLogout($request);

        if (!config('cart.destroy_on_logout')){
            $cart->each(function ($rows , $identifier) use ($request){
               $request->session()->put('cart.' . $identifier , $rows);
            });
        }

        return $response;
    }
    protected function loggedOut(Request $request)
    {
        Cache::forget('admin_side_menu');
        Cache::forget('roles_routes');
        Cache::forget('user_routes');
    }
}
