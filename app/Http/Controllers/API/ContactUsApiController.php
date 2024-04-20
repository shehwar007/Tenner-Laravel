<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventOffer\Favourite;
use App\Models\Contact;
use App\Models\BasicSettings\Basic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging
use Carbon\Carbon;

class ContactUsApiController extends Controller
{
    /**
     * Register a new customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'query' => 'required',
                'user_id' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
        
            try {
                $contact = new Contact;
                $contact->user_id = $request->user_id;
                $contact->query = $request->input('query'); // Accessing query from request body
                $contact->save();
        
                if ($contact) {
                    $data = [
                        'data' => 'Your Thoughts Added Successfully',
                        'message' => 'success'
                    ];
                    return response()->json($data, 200);
                } else {
                    return response()->json(['error' => 'Failed to Add Thoughts'], 500);
                }
            } catch (\Exception $e) {
                Log::error('Error storing contact: ' . $e->getMessage());
                return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
            }
        }

}
