<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Validator, Auth, Hash;
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

    private $headers = [
        'Access-Control-Allow-Origin' => '*',
    ];

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'password' => 'required|confirmed|min:6',
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

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if(($email == '') || ($password == ''))
        {
           return response()->json([], 401, $this->headers);
        }
        else
        {
            $user = User::where('email', $email)->first();

            if(is_null($user) || !Hash::check($password, $user->password))
            {
                return response()->json([], 401, $this->headers);
            }
            else
            {
                $user->token = str_random(30);
                $user->save();

                return response()->json(['id' => $user->id, 'token' => $user->token], 200, $this->headers);
            }
        }
    }

    public function logout(Request $request, $id)
    {
        $user = User::find($id);

        if($user->token == $request->get('token'))
        {
            $user->token = '';
            $user->save();

            return response()->json([], 200, $this->headers);
        }
        else
        {
            return response()->json([], 404, $this->headers);
        }
    }
}
