<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Favourite;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ProfileApiController extends Controller
{
    /**
     * Register a new customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user  = User::select('id', 'fname', 'lname', 'email','phone','photo')->where('id', $request->user_id)->first();

        if ($user != null) {
            $data = array(
                'data' => $user,
                'user_profile_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/user-profile/',
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'User Record Not Found'], 400);
        }
    }

    public function edit_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        

        $customer  = User::select('id','photo')->where('id', $request->user_id)->first();

        if ($customer != null) {
            $data = array(
                'data' => $customer,
                'user_profile_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/user-profile/',
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'User Record Not Found'], 400);
        }
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'photo' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $id = $request->user_id;
        $customer = User::find($id);
        $in = $request->all();
        $file = $request->file('photo');
        if ($file) {
            // delete existing image on update 
             $directory = public_path('assets/admin/img/user-profile/');
            if ($customer->photo != null) {
                $delImgPath = $directory.$customer->photo;
                if (File::exists($delImgPath)) {
                    File::delete($delImgPath);
                }
            }
            
            $extension = $file->getClientOriginalExtension();
             
            $fileName = uniqid() . '.' . $extension;
            @mkdir($directory, 0775, true);
            $file->move($directory, $fileName);
            $in['photo'] = $fileName;
        }
        try {
            $customer = User::find($id);

            if ($customer != null) {
                // Update customer with the provided data
                $customer->update($in);
            
                // Fetch the updated customer record
                $updatedCustomer = User::select('id', 'fname', 'lname', 'photo', 'email')->find($id);
            
                if ($updatedCustomer != null) {
                    $data = [
                        'data' => $updatedCustomer,
                        'user_profile_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/user-profile/',
                        'message' => 'success'
                    ];
                    return response()->json($data, 200);
                } else {
                    // Return error response if updated customer record not found
                    return response()->json(['error' => 'Failed to retrieve updated User data'], 500);
                }
            } else {
                // Return error response if customer not found
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
