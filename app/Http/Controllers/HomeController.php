<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->news = new News();
        $this->user = new User();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestPosts = $this->news->getLatestPosts();
        return view('index', compact('latestPosts'));
    }

    /*
     * Custom method to load Password Reset form.
     */
    public function resetForm(){
        return view('auth.password_reset');
    }

    /*
     * Custom method to send password reset link
     */
    public function passwordReset(Request $request){
        $validator = Validator::make($request->all(),['email' => 'required|string|email']);
        if($validator->fails()){
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }
        $is_valid = User::where('email', $request->email)->first();
        if(count($is_valid) > 0){
            $time = strtotime(date('Y-m-d H:i:s', strtotime('+1 days')));
            $email_enc = base64_encode($request->email);
            $token = $time.'@'.$email_enc;
            $token_exist = DB::table('password_resets')->where('email', $request->email)->first();
            if(count($token_exist) > 0){
                $password_reset = DB::table('password_resets')->where('email', $request->email)->update([
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $password_reset = DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            $email = $request->email;
            $name = $is_valid->first_name.' '.$is_valid->last_name.',';
            if($password_reset){
                $link = route('passwordResetForm', $token);
                $html = 'Hi '.$name;
                $html .= '<br/> You recently requested to reset your password. Click the button below to reset it.';
                $html .= '<br/> <a href="'.$link.'" style="background-color: #1980b6;border-color: #1980b6;border-radius: 100px;
color: #ffffff;font-family: Montserrat;font-size: 16px;font-weight: normal;height: 43px;line-height: 30px;margin-bottom: 13px;
margin-top: 10px;padding: 6px 15px;text-transform: uppercase;">Reset your password</a>';

                $this->user->sendEmail($email,$html,'Password Reset');
                session()->flash('success', 'We have sent you password reset link.');
                return Redirect::back();
            }
            session()->flash('error', 'Something went wrong, please try again later.');
            return Redirect::back();
        } else {
            $check_email = Validator::make(['email' => ''],['email' => 'required'],['email.required' => 'We can\'t find a user with that e-mail address.']);
            if($check_email->fails()){
                return Redirect::back()->withInput($request->all())->withErrors($check_email);
            }
            session()->flash('error', 'We can\'t find a user with that e-mail address.');
        }
    }

    /*
     * Method to load password reset form
     */
    public function passwordResetForm($token){
        $token_exist = DB::table('password_resets')->where('token', $token)->first();
        if(count($token_exist) > 0){
            $split_token = explode('@', $token);
            if(strtotime($token_exist->created_at) <= $split_token[0]){
                return view('auth.password_reset_form', compact('token'));
            } else {
                session()->flash('error', 'Password reset token is expire.');
                return view('auth.password_reset_form', compact('token'));
            }
        }
        return Redirect::to('/');
    }

    /*
     * Method to update password
     */
    public function savePasswordReset($token, Request $request){
        $rules = [
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }
        $token_exist = DB::table('password_resets')->where('token', $token)->first();
        if(count($token_exist) > 0){
            $save = User::where('email', $token_exist->email)->update([
                'password' => bcrypt($request->password)
            ]);
            $delete_token = DB::table('password_resets')->where('token', $token)->delete();
            $user = User::where('email', $token_exist->email)->update(['is_verified' => 1]);
            Auth::attempt(['email' => $token_exist->email, 'password' => $request->password]);
            session()->flash('success', 'Password updated successfully.');
            return Redirect::back();
        }
        session()->flash('error', 'Something went wrong, please try again later.');
        return Redirect::back();

    }
}
