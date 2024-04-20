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
use App\Models\EventOffer;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging

class EventOfferApiController extends Controller
{
    public function list(Request $request)
    {
            // dd("enter");
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $limit = 25; 
        if (isset($request->offset)) {
            $offset = $request->offset; // Get the offset from the request, default to 0
        } else {
            $offset = 0;
        }

        try {
            // $event_offers = EventOffer::orderBy('id', 'desc')
            //     ->skip($offset)
            //     ->take($limit)
            //     ->get();

               $event_offers = EventOffer::with([
                    'favourite' => function ($query) use ($request) {
                        $query->select('*')->where('user_id', $request->user_id);
                    },
                ])->leftJoin("vendors", 'vendors.id', 'event_offers.vendor_id')
                    ->select('event_offers.*', 'vendors.longitude', 'vendors.latitude', 'vendors.name')
                    ->where('event_offers.status', 1);
                
                if ($request->filter == 'alphabatically') {
                    $event_offers->orderBy('event_offers.rest_title', 'asc');
                } else {
                    $event_offers->orderBy('event_offers.updated_at', 'desc');
                }
                
                $event_offers = $event_offers->skip($offset)
                    ->take($limit)
                    ->get();


                
            if (count($event_offers) > 0) {
                    $response = [
                        'data' => $event_offers,
                        'message' => 'success',
                        'r_logo_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/',
                        'media_content_path' =>'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/media-content/',
                        'next_offset' => $offset + $limit,
                    ];
                    return response()->json($response, 200);
                } 
            else {
                return response()->json(['error' => 'Event Offer Not Found.'], 400);
            }
        } catch (\Exception $e) {
            // return response()->json($e->getMessage(), 400);
            return response()->json(['error' => 'Event Offer Not Found.'], 400);
        }
    }
     
     public function store($id)
     {
         $EventOffer = EventOffer::find($id);
         if($EventOffer!=null){
         $EventOffer->seen = 1; 
         $EventOffer->save();
         if($EventOffer){
             $response = [
                'data' => 'Media Content Seen',
                'message' => 'success',
            ];
            return response()->json($response, 200);
         }
         else{
            return response()->json(['error' => 'Media Content Not Seen.'], 400); 
         }
         }
         else{
            return response()->json(['error' => 'Not Found Event Media Content'], 400);  
         }
     } 
     
     
     public function GetById($id)
     {
         $checkEventOffer = EventOffer::where('id', $id)->first();

if ($checkEventOffer != null) {
    $EventOffer = EventOffer::where('event_offers.id', $id)
        ->leftJoin("vendors", 'vendors.id', '=', 'event_offers.vendor_id')
        ->select('event_offers.*', 'vendors.longitude', 'vendors.latitude', 'vendors.name')
        ->where('event_offers.status', 1)
        ->first();

    $response = [
        'data' => $EventOffer,
        'message' => 'success',
    ];
    return response()->json($response, 200);
} else {
    return response()->json(['error' => 'Event Not Found'], 400);
}

     } 
    
}
