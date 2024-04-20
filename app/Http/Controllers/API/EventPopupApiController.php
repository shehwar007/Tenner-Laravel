<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Favourite;
use App\Models\Event;
use App\Models\EventOffer\EventPopup;
use App\Models\EventOffer\EventPopupClick;
use App\Models\Customer;
use App\Models\CustomPage\PageContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class EventPopupApiController extends Controller
{
    
    public function popup(Request $request)
    {
        // Retrieve the first event popup
        $event_popup = EventPopup::first();
    
        // Check if the event popup exists
        if ($event_popup) {
            // If it exists, prepare the response data
            $data = [
                'data' => $event_popup,
                 'circle_pic_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/event-popup/',
                 'flyer_pic_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/event-popup/',
                'message' => 'success'
            ];
            // Return a JSON response with the data and HTTP status 200 (OK)
            return response()->json($data, 200);
        } else {
            // If the event popup does not exist, return an error response with HTTP status 404 (Not Found)
            return response()->json(['error' => 'Event Popup Not Found'], 404);
        }
    }
    
    public function click(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'offer_id' => 'required',
        ]);
        
         if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $userId = $request->user_id;
        $offerId = $request->offer_id;
        
        // Here Check userId & offerId
        
        $user = DB::table('users')->where('id', $userId)->first();
        $offer = DB::table('event_offers')->where('id', $offerId)->first();
        
        if(!$user){
               $data = [
                'data' => "Invalid User Id",
                'message' => 'error'
            ];
    
            return response()->json($data, 400);
        }
        
        
        if(!$offer){
            $data = [
                'data' => "Invalid Offer Id",
                'message' => 'error'
            ];
            // Return a JSON response with the data and HTTP status 200 (OK)
            return response()->json($data, 400);
        }
        $dataExists = EventPopupClick::
                    where('user_id', $userId)
                    ->where('offer_id', $offerId)
                    ->first();
                    
        if($dataExists){
            $dataExists->clicks += 1;
            $dataExists->save();
            $data = [
                'data' => "Clicks Added Successfully!",
                'message' => 'success'
            ];
            // Return a JSON response with the data and HTTP status 200 (OK)
            return response()->json($data, 200);
            
        }else{
            $newclick = new EventPopupClick();
            $newclick->user_id = $userId;
            $newclick->offer_id = $offerId;
            $newclick->clicks = 1;
            $newclick->save();
            
            
            $data = [
                'data' => "Clicks Added Successfully!",
                'message' => 'success'
            ];
            // Return a JSON response with the data and HTTP status 200 (OK)
            return response()->json($data, 200);
        }
        
    }
    

}
