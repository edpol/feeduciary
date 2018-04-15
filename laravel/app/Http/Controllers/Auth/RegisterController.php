<?php

namespace feeduciary\Http\Controllers\Auth;

use Hash;
use feeduciary\User;
use feeduciary\Rate;
use feeduciary\Advisor;
use feeduciary\Mail\Welcome;
use feeduciary\Http\Controllers\Controller;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:3'
        ]);
    }

    protected function experiment()
    {
        if ($validator->fails()) {
            return redirect('post/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \feeduciary\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'user_id'  => $data['advisor_id'],
        ]);
    }

    public function validating() {
        // Validate the form.  email checks email format
        $validation = $this->validate(request(), [
            'name'                  => 'required|string|min:2',
            'email'                 => 'required|string|email|unique:users',
            'password'              => 'required|string|min:3|confirmed',
            'password_confirmation' => 'required|string|min:3'
        ]);
        return $validation;
    }

    // I'm guessing here
    public function store() {
        $data = $this->validating();
        $data["advisor_id"] = (isset($advisor->id) && !empty($advisor->id)) ? $advisor->id : 0;

        // Create and save the user
        $user = $this->create($data);

        // Sign them in
        auth()->login($user);

        $data['id'] = $user->id;
        $data['server_name'] = env('APP_URL');

        \Mail::to($user)->send(new Welcome($user));

        // After creating your USER information, we need your ADVISOR information

        // use user->id to get record from ADVISOR table
        // if there is no advisor entry, go to advisor entry page
        $advisor = Advisor::where("user_id",$user->id)->first();
        // if i time out it errors here
        $count = (is_null($advisor)) ? 0 : $advisor->count();
        if ($count==0) {
            $state = optionState();
            return view('advisors.entry', compact('user','state'));
        } else {
            $rates = $advisor->rate;
            $advisor = checkURLs($advisor);
            return view('advisors.edit', compact('advisor','rates'));
        }
    }

    /*  create user and point to advisor
     *  update advisor to point to user
     *  then go to login  
     */
    public function claim(Advisor $advisor) {
        return view('auth.register', compact('advisor'));
    }

    public function connect(Advisor $advisor) {
        $data = $this->validating();
        $data["advisor_id"] = (isset($advisor->id) && !empty($advisor->id)) ? $advisor->id : 0;
        $user = $this->create($data);
// $advisor->find($advisor->id)->update(['user_id' => $user->id]);  ??
        Advisor::where('id', '=', $advisor->id)->update(['user_id' => $user->id]);
        auth()->login($user);
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('advisors.edit', compact('advisor', 'rates'));
// maybe go to return redirect('/update'); instead?
    }
}
