<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SocialAuthController extends Controller
{
  protected $redirectPath ='/';
          
  public function redirectToProviderFb() {
    return Socialite::with('facebook')->redirect();
  }
  
  public function handleProviderCallbackFb()
    {   
        $fbUser = Socialite::with('facebook')->user();
        $user = User::where('email', $fbUser->email)->first();
        if (is_null($user)) {
            $user = User::create([
                        'email' => $fbUser->getEmail(),
                        'name' => $fbUser->getName(),
                        'avatar' => $fbUser->getAvatar(),
                        'fb_profileUrl'=>$fbUser->profileUrl,
            ]);
        }
        Auth::login($user);

        return redirect()->back();

    }
          
  public function redirectToProviderVk() {
    return Socialite::with('vkontakte')->redirect();
  }
  
  public function handleProviderCallbackVk(){   
        $vkUser = Socialite::with('vkontakte')->user();
        
        $user = User::where('email', $vkUser->email)->first();

        if (is_null($user)) {
          
            $user = User::create([
                        'email' => $vkUser->getEmail(),
                        'name' => $vkUser->getName(),
                        'avatar' => $vkUser->getAvatar(), 
            ]);
        }
        Auth::login($user);

        return redirect()->back();
  }
}
