<?php

namespace App\Http\Controllers\Auth;

use App\PendingUser;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $hashed_user_id;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Override showRegistrationForm() method to disable Register route.
     */
    public function showRegistrationForm()
    {
        return redirect('/');
    }

    // Override method
    public function postLogin(\Illuminate\Http\Request $request)
    {
        $pending_user = PendingUser::where('email', $request->input('email'))->first();
        $user = User::where('email', $request->input('email'))->first();

        if ($pending_user && !$user) {
            $this->hashed_user_id = bcrypt($pending_user->id);
            $this->hashed_user_id = str_replace('/', '@@@@@', $this->hashed_user_id);

            $new_user = new User();
            $new_user->username = $pending_user->username;
            $new_user->email = $pending_user->email;
            $new_user->password = $pending_user->password;
            $new_user->save();
            return Redirect::action('Auth\AuthController@firstLoginForm', ['hashed_id' => $this->hashed_user_id]);
        }
        elseif ($pending_user && $user) {
            $this->hashed_user_id = bcrypt($pending_user->id);
            $this->hashed_user_id = str_replace('/', '@@@@@', $this->hashed_user_id);
            return Redirect::action('Auth\AuthController@firstLoginForm', ['hashed_id' => $this->hashed_user_id]);
        }
        return $this->login($request);
    }

    // New admin change password on first login
    public function firstLoginForm($hashed_id)
    {
        return view('admin.firstLoginForm', compact('hashed_id'));
    }

    // First login
    public function firstLogin(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|string|min:6',
            'password_confirm' => 'required|string|min:6|same:new_password'
        ]);

        $hashed_id = $request->input('hashed_id');
        $hashed_id = str_replace('@@@@@', '/', $hashed_id);
        $pending_users = PendingUser::all();

        $result = 'Something is wrong. Please try again!';
        $alert_type = 'warning';

        foreach ($pending_users as $pd) {
            if (Hash::check($pd->id, $hashed_id)) {
                $user = User::where('email', $pd->email)->first();
                $user->password = bcrypt($request->input('new_password'));
                $user->save();
                $pd->delete();
                $result = 'Password successfully updated! Please login again with your new password';
                $alert_type = 'success';
                break;
            }
        }
        return view('auth.login', compact('result', 'alert_type'));
    }
}
