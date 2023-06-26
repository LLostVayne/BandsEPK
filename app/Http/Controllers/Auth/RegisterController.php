<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['user_type'] == "guest") {
            $guestRole = Role::where('name','guest')->first();

            if (!$guestRole) {
                $guestRole = Role::Create(['name' => 'guest']);

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                $user->assignRole($guestRole);
            }
        } else if ($data["user_type"] == "admin") {
            $adminRole = Role::where('name', 'admin')->first();

            if (!$adminRole) {
                $adminRole = Role::create(['name' => 'admin']);
    
                $createBandsPermission = Permission::create(['name' => 'create bands']);
                $editBandsPermission = Permission::create(['name' => 'edit bands']);
                $deleteBandsPermission = Permission::create(['name' => 'delete bands']);
    
                $adminRole->givePermissionTo($createBandsPermission, $editBandsPermission, $deleteBandsPermission);
            }
    
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
    
            $user->assignRole($adminRole);
        } else {
            abort(500);
        }

        return $user;
    }
}