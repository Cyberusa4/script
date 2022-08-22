<?php

namespace App\Http\Controllers\Frontend\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Models\SocialProvider;
use App\Models\User;
use App\Models\UserLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
    protected $providers = ['facebook'];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a log or update an exists one
     *
     * @return void
     */
    protected function setLog($user)
    {
        $ip = vIpInfo()->ip;
        $userLog = UserLog::where([['user_id', $user->id], ['ip', $ip]])->first();
        $log = new UserLog();
        if ($userLog != null) {
            $userLog->country = vIpInfo()->country;
            $userLog->country_code = vIpInfo()->country_code;
            $userLog->timezone = vIpInfo()->timezone;
            $userLog->location = vIpInfo()->location;
            $userLog->latitude = vIpInfo()->latitude;
            $userLog->longitude = vIpInfo()->longitude;
            $userLog->browser = vBrowser();
            $userLog->os = vPlatform();
            $userLog->update();
        } else {
            $log->user_id = $user->id;
            $log->ip = vIpInfo()->ip;
            $log->country = vIpInfo()->country;
            $log->country_code = vIpInfo()->country_code;
            $log->timezone = vIpInfo()->timezone;
            $log->location = vIpInfo()->location;
            $log->latitude = vIpInfo()->latitude;
            $log->longitude = vIpInfo()->longitude;
            $log->browser = vBrowser();
            $log->os = vPlatform();
            $log->save();
        }
    }

    /**
     * Create a new social provider
     *
     * @return void
     */
    public function createProvider($authUser, $provider, $socialUser)
    {
        $socialProvider = new SocialProvider();
        $socialProvider->user_id = $authUser->id;
        $socialProvider->$provider = $socialUser->id;
        $socialProvider->save();
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.user.auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ] + ReCaptchaValidation::validate());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (userAuthInfo()->status == 0) {
            Auth::logout();
            toastr()->error(lang('Your account has been blocked', 'alerts'));
            return redirect()->route('login');
        }
        $this->setLog($user);
    }

    /**
     * Login using socialite redirect to provider
     *
     * @return // Redirect to provider
     */
    public function redirectToProvider($provider)
    {
        abort_if(!in_array($provider, $this->providers), 404);
        abort_if(!env('FACEBOOK_CLIENT_ID') || !env('FACEBOOK_CLIENT_SECRET'), 404);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Login using socialite redirect to provider
     *
     * @var // $provider
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            abort_if(!in_array($provider, $this->providers), 404);
            $socialUser = Socialite::driver($provider)->user();
            if ($provider == "facebook") {
                $exist = SocialProvider::where('facebook', $socialUser->id)->first();
                try {
                    if ($exist) {
                        $user = User::find($exist->user_id);
                        $this->setLog($user);
                        Auth::login($user);
                        return redirect()->route('filemanager.index');
                    } else {
                        if (!settings('website_registration_status')) {
                            toastr()->error(lang('Registration is currently disabled.', 'alerts'));
                            return redirect()->route('login');
                        }
                        $name = explode(' ', $socialUser->name);
                        $sessionDetails = [
                            'provider' => $provider,
                            'id' => $socialUser->id,
                            'firstname' => $name[0] ?? null,
                            'lastname' => $name[1] ?? null,
                            'email' => $socialUser->email ?? null,
                            'avatar' => $socialUser->avatar,
                        ];
                        $token = encrypt($sessionDetails);
                        Session::put('provider_data', $token);
                        return redirect()->route('complete.registration', $token);
                    }
                } catch (\Exception $e) {
                    toastr()->error(lang('Connection error please try again', 'alerts'));
                    return redirect()->route('login');
                }
            }
        } catch (\Throwable $e) {
            return redirect()->route('login');
        }
    }
}
