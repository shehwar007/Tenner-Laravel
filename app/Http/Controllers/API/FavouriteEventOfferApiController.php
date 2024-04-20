<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventOffer\Favourite;
use App\Models\EventOffer;
use App\Models\BasicSettings\Basic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Add the Log facade for logging
use Carbon\Carbon;

class FavouriteEventOfferApiController extends Controller
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
            'event_id' => 'required',
            'user_id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $favourite = new Favourite;
        $favourite->user_id  =  $request->user_id;
        $favourite->event_id  =  $request->event_id;
        $favourite->save();
        if ($favourite) {
            $data = array(
                'data' => $favourite,
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Failed to Add Favourite'], 400);
        }
    }

    public function remove(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $favourite = Favourite::find($request->id);
        if ($favourite) {
            $favourite->delete();
            $data = array(
                'data' => 'Remove Event From Favourite Successfully!',
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Not Found Any Event to Remove From Favourite'], 400);
        }
    }


    public function all_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        // return response()->json('Enter');
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $limit = 25; // Set the limit for the number of records to retrieve
        if (isset($request->offset)) {
            $offset = $request->offset; // Get the offset from the request, default to 0
        } else {
            $offset = 0;
        }

$favourites = Favourite::with([
    'events' => function ($query) {
        $query->where('status', 1)->select('*');
    },
])->select('id', 'user_id', 'event_id')
    ->where('user_id', $request->user_id)
    ->whereHas('events', function ($query) {
        $query->where('status', 1);
    }) // Only include favourites with associated events having status 1
    ->orderBy('id', 'desc')
    ->skip($offset)
    ->take($limit)
    ->get();



        if (count($favourites) > 0) {
                $response = [
                    'data' => $favourites,
                    'message' => 'success',
                    'r_logo_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/',
                    'media_content_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/media-content/',
                    'next_offset' => $offset + $limit,
                ];
                return response()->json($response, 200);
            }
         else {
                $response = [
                    'data' => [],
                    'message' => 'success',
                    'r_logo_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/',
                    'media_content_path' => 'https://tennerdealsapi.envobyte.dev/assets/admin/img/vendor-photo/media-content/',
                ];
                return response()->json($response, 200);
            // return response()->json(['error' => 'All Favourite Events Not Found.'], 400);
        }
    }
}
