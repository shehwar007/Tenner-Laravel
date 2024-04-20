<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import the Customer model
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging
use Illuminate\Support\Facades\Hash as Hasher;

class RegisterApiController extends Controller
{
    /**
     * Register a new customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $errors = [];

                    if (strlen($value) < 8) {
                        $errors[] = 'Requires at least 8 characters.';
                    }
                    // Check for at least one uppercase letter
                    elseif (!preg_match('/[A-Z]/', $value)) {
                        $errors[] = 'A necessary capital letter.';
                    }
                    // Check for at least one special character
                    elseif (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
                        $errors[] = 'At least one symbol required.';
                    }

                    if (!empty($errors)) {
                        $fail(implode(PHP_EOL, $errors));
                    //    / $fail($errors);
                        

                    }
                },
            ],
            'confirm_password' => 'required|same:password',
            'term_condition' => 'accepted',
        ], [
            'term_condition.accepted' => 'You must accept the term conditions.',
            'password.required' => 'The Password Field is Required',
            'password.min' => '8 characters min for the pass',
            'confirm_password.same' => 'Passes do not match',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

            $input = $request->except(['confirm_password']);
            $input['password'] = Hash::make($input['password']);
            $input['term_condition'] = 1;
            
            $user = User::create($input);
 
            if($user){  
                $response = [
                    'data' => 'User Registered Successfully!',
                    'message' => 'success',
                ];
                return response()->json($response, 200);
            }
            else{
                return response()->json(['error' => 'User Not Register'], 400);  
            }
    }
    
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Attempt to authenticate the customer
            if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
                $customer = Auth::guard('web')->user();
                // if($customer->email_verified_at==null){
                //     return response()->json(['error' =>"Email Not Verified"], 400);   
                // }
                 
                $token = $customer->createToken('TennerDeals')->plainTextToken;

                $customer_data = array(
                    'id' => $customer->id,
                    'fname' => $customer->fname,
                    'email' => $customer->email,
                );

                $data = array(
                    'data' => $customer_data,
                    'token' => $token,
                    'message' => 'success'
                );
                return response()->json($data, 200);
             
            } else {
                // Authentication failed
                return response()->json(['error' =>"Incorrect email or password"], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' =>"Incorrect email or password"], 400);
        }
    }



    public function social_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'provider' => 'required',
            'provider_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // try {
            $findcustomer = User::where('provider_id', $request->provider_id)->first();
            if ($findcustomer) {
              
                 Auth::guard('web')->login($findcustomer);
                 $token = $findcustomer->createToken('TennerDeals')->plainTextToken;  
                
                $customer_data = array(
                    'id'    => $findcustomer->id,
                    'fname' => $findcustomer->fname,
                    'email' => $findcustomer->email,
                    'phone' => $findcustomer->phone,
                );

                $data = array(
                    'data' => $customer_data,
                    'token' => $token,
                    'message' => 'success'
                );
                return response()->json($data, 200);
            } else {
                if (isset($request->email)) {
                    $email = $request->email;
                    $validator = Validator::make($request->all(), [
                        'email' => 'unique:users,email',
                    ], [
                        'email.unique' => 'This email address is already use to your another account.',
                    ]);
                    
                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], 422);
                    }     
                } else {
                    $email = null;
                }
                
                if (isset($request->phone)) {
                    $phone = $request->phone;
                } else {
                    $phone = null;
                }
            
                $customer = User::create([
                    'fname' => $request->fname,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => Hasher::make('ThisIsTennerDealsPassword@%21*1'),
                    'provider_id' => $request->provider_id,
                    'provider' => $request->provider,
                ]);

                Auth::guard('web')->login($customer);      
              
                $token = $customer->createToken('TennerDeals')->plainTextToken;
               
                $customer->email_verified_at = now()->toDateTimeString();    
                $customer_data = array(
                    'id'    => $customer->id,
                    'fname' => $customer->fname,
                    'email' => $customer->email,
                );

                $data = array(
                    'data' => $customer_data,
                    'token' => $token,
                    'message' => 'success'
                );
                return response()->json($data, 200);
            }
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Unauthorized User', 'error detail'=>$e], 401);
        // }
    }
    
    
     public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $customer  = User::where('email', $request->email)->whereNull('provider')->first();

        if ($customer !== null) {
            $otp_code = random_int(1000, 9999);
            try {
                $customer->update(['otp_code' => $otp_code]);
                $data = [
                    'otp_code' => $otp_code,
                    'username' => $customer->fname
                ];
                $user['to'] = $request->email;
                
                Mail::send('frontend.forgot-password-otpcode', $data, function ($messages) use ($user) {
                    $messages->to($user['to'], 'email');
                    $messages->subject('Your PIN for Reset Password', $user['to']);
                });

                $data = array(
                    'data' => 'OTP Code Send Successfully',
                    'message' => 'success'
                );
                return response()->json($data, 200);
            } catch (\Exception $e) {
                // Handle database update error
                return response()->json(['error' => "Email Not Found"], 500);
            }
        } else {
            return response()->json(['error' => "Email Not Found"], 500);
        }
    }
    
    
    public function match_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp_code' => 'required',
        ],[
            'otp_code.required' => 'Otp Code is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $customer  = User::select('otp_code')->where('email', $request->email)->whereNull('provider')->where('otp_code', $request->otp_code)->first();

        if ($customer !== null) {
            if ($customer->otp_code == $request->otp_code) {
                try {
                    User::select('otp_code')->where('email', $request->email)->whereNull('provider')->update([
                        'otp_code' => null
                    ]);

                    $data = array(
                        'data' => 'Pin Valid',
                        'message' => 'success'
                    );
                    return response()->json($data, 200);
                } catch (\Exception $e) {
                    // Handle database update error
                    return response()->json(['error' => 'Pin Not Match'], 500);
                }
            } else {
                return response()->json(['error' => 'Pin Not Match'], 500);
            }
        } else {
            return response()->json(['error' => 'Pin Not Match'], 500);
        }
    }


    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $errors = [];

                    if (strlen($value) < 8) {
                        $errors[] = 'Requires at least 8 characters.';
                    }

                    // Check for at least one uppercase letter
                    elseif (!preg_match('/[A-Z]/', $value)) {
                        $errors[] = 'A necessary capital letter.';
                    }
                    // Check for at least one special character
                    elseif (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
                        $errors[] = 'At least one symbol required.';
                    }

                    if (!empty($errors)) {
                        // $fail(implode(PHP_EOL, $errors));
                        $fail($errors);
                    }
                },
            ],
            'confirm_password' => 'required|min:8|same:password',
        ], [
            'password.required' => 'Password required.',
            'password.min' => '8 characters min for the pass.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.min' => '8 characters min for the pass.',
            'confirm_password.same' => 'Passes do not match.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $plainPassword = $request->password;
        $hashedPassword = Hash::make($plainPassword);

        $customer = User::where('email', $request->email)->update([
            'password' => $hashedPassword
        ]);
        if ($customer) {
            $data = array(
                'data' => 'Password Change Successfully',
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Password not changed'], 500);
        }
    }
    
    
    
    

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $customer = $request->user();
            // return response()->json($token);
            // User::find($customer->id)->update(['device_token'=>NULL]);
            $token = $request->user()->currentAccessToken()->delete();

            if ($token) {
                $data = array(
                    'data' => 'Logged out successfully',
                    'message' => 'success'
                );
                return response()->json($data, 200);
            } else {
                return response()->json(['error' => "The User was unable to log out"], 404);
            }

            return response()->json(['error' => "The User was unable to log out"], 500);
        } catch (\Exception $e) {
            // Handle database update error
            return response()->json(['error' => "The User was unable to log out"], 404);
        }
    }
    
    
    
    public function test(Request $request){
        dd("enter");
    }
}
