<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\AffiliateRegisterMail;
use App\Mail\EmailVerificationMail;
use App\Models\LoginLog;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Models\Vendor;
use Illuminate\Support\Str;
use App\Notifications\MailVerificationNotification;
use Carbon\Carbon;
use App\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
use Brian2694\Toastr\Facades\Toastr;

class AuthController extends Controller
{
  

    public function verifyCode(){
        return view('auth.verify-email');
    }
    public function verifyEmail(){
       
        return view('auth.verify-email');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        if (User::where('email', $request->email)->doesntExist()) {
            return response([
                'status' => 'error',
                'message' => 'Email not found'
            ], 404);
        }
        $token = $this->randomString();
        try {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token
            ]);
            Mail::to($request->email)->send(new PasswordResetMail($token));
            return response([
                'status' => 'success',
                'message' => 'Check your email'
            ]);
        } catch (\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    private function randomString()
    {
        $random = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $result = substr(str_shuffle($random), 0, 10);
        return $result;
    }


    public function sendcode(Request $request){
     
    
        
        if(Auth::guard('vendor')->user()){
              
        $id = Auth::guard('vendor')->user()->id;
          
        $user = Vendor::where('id', $id)->first();
        
      
        
        
        $email = $user->email;

        $randomString = Str::random(10);


        $user->verify_token = $randomString;

        $link = 'https://tennerdealsapi.envobyte.dev/email/verified/'. $randomString;
        $user->save();
        


        $data = [
            'email' => $email,
            'link'=>$link,
          ];


           $user['to'] = $email;
           Mail::send('mail', $data, function ($messages) use ($user) {
               $messages->to($user['to'], 'email');
               $messages->to($user['to'], 'link');
               $messages->subject('Verify Email', $user['to']);
           });
            Session::flash('alert', 'Email is Sent. Please Check your Email !');
           return redirect()->back();
       
    }else{
        return redirect()->back();
    }


    }


    public function verify($token)
    {
    
         
        $user = Vendor::where('verify_token', $token)->first();
        
        // dd($user);
        // $user->update([
        //     'email_verified_at'=>Carbon::now(),
        //     'verify_token'=>null,
        // ]);
        $user->email_verified_at = Carbon::now();
        $user->verify_token = null;
        $user->save();
        
         Auth::guard('vendor')->login($user);
        // dd("updated");
        
        // $user = auth()->user();

        // return redirect('/vendor/dashboard');
         return redirect()->route('vendor.event_management.event');
   
    
       
        // return redirect('/login')->with('success','Email Verified. Account is Now on Pending..');

    }
    
    public function autoverify($token)
    {
    
        $user = User::where('verify_token',$token)->firstOrFail();

        
        $user->update([
            // 'email_verified_at'=>Carbon::now(),
            'verify_token'=>null,
          
        ]);
        
        $user = auth()->user();
        $user->login();
    
     

    }
    
    public function manualverify($token, $expire, $signature){
        dd($token);
    }
    
    public function code()
    {
       
        $random = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $data = substr(str_shuffle($random),0,70);
        $user = Auth::user();
        $affiliate = User::where('id' , $user->id)->first();
        $user->update([
            'verify_token'=>$data,
        ]);
        
        $link = "https://publisher.affsmartlink.store/email/verify/" .$data;
        
       
        
        // dd($affiliate);
        $template = EmailTemplate::where('id', 15)->first();
        Notification::send($affiliate, new MailVerificationNotification($affiliate,  $template, $link));
            
        return back()->with('success','Link Sent successfully');
    }
}
