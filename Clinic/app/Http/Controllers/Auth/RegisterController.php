<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Client;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/client';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone' => ['required', 'string','regex:/[0-9]{9}/','unique:users'],
            'CC' => ['required','string','regex:/[0-9]{1,9}/','unique:clients'],
            'adse' => ['nullable', 'string','regex:/[0-9]{1,10}/'],
            'morada' => ['required', 'string'],
            'idade' => ['nullable', 'date']
        ]);
    }


    protected function create(array $data)
    {
        DB::beginTransaction();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cellphone' => $data['cellphone'],
        ]);


        $client = Client::create([
              'user_id' =>  $user->id,
              'CC' => $data['CC'],
               'adse' => $data['adse'],
               'morada' => $data['morada'],
              'idade' => $data['idade']  
         ]);

        DB::commit();

        return $user;
    }
}
