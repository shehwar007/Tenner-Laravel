<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Favourite;
use App\Models\Event;
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


class CustomPagesApiController extends Controller
{
    
    public function term_conditions(Request $request)
    {
        $terms_condition = PageContent::select('id','content')
            ->first();

        if ($terms_condition != null) {
            $data = array(
                'data' => $terms_condition,
                'message' => 'success'
            );
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Terms and Conditions Not Found'], 400);
        }
    }

}
