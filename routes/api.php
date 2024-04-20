<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterApiController;
use App\Http\Controllers\API\EventOfferApiController;
use App\Http\Controllers\API\CustomPagesApiController;
use App\Http\Controllers\API\FavouriteEventOfferApiController;
use App\Http\Controllers\API\EventPopupApiController;
use App\Http\Controllers\API\ContactUsApiController;
use App\Http\Controllers\API\ProfileApiController;
use App\Models\User;
use App\Models\Vendor;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API', 'prefix' => 'v1/', 'as' => 'v1.'], function () {
    
    Route::get('test', [RegisterApiController::class, 'test']);
     
    Route::post('register', [RegisterApiController::class, 'register']);
    Route::post('login', [RegisterApiController::class, 'login']);
    Route::post('forgot_password', [RegisterApiController::class, 'forgot_password']);
    Route::post('match_otp', [RegisterApiController::class, 'match_otp']);
    Route::post('change_password', [RegisterApiController::class, 'change_password']);
  
    Route::post('social_login', [RegisterApiController::class, 'social_login']);
    // Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [RegisterApiController::class, 'logout']);
        
        Route::prefix('event_offers/')->group(function () {
            Route::post('list', [EventOfferApiController::class, 'list']);
            Route::get('store_status_seen/{id}', [EventOfferApiController::class, 'store']);
            Route::get('getById/{id}', [EventOfferApiController::class, 'GetById']);
          });

        Route::prefix('page/')->group(function () {
            Route::get('term_conditions', [CustomPagesApiController::class, 'term_conditions']);
          });
          
        Route::prefix('event/')->group(function () {
           Route::get('popup', [EventPopupApiController::class,'popup']);
           // Event Popup Click
           Route::post('click', [EventPopupApiController::class, 'click']);
        });  

       // Favourite Events  Routes On App   
            Route::prefix('favourite/')->group(function () {
                Route::post('store', [FavouriteEventOfferApiController::class, 'store']);
                Route::post('all_list', [FavouriteEventOfferApiController::class, 'all_list']);
                Route::post('remove', [FavouriteEventOfferApiController::class, 'remove']);
            });
            //  End Here   
            
                 // Profile Routes On App   
               Route::prefix('profile/')->group(function () {
                Route::post('user', [ProfileApiController::class, 'profile']);
                Route::post('edit_profile', [ProfileApiController::class, 'edit_profile']);
                Route::post('update_profile', [ProfileApiController::class, 'update_profile']);
              });
              //user avatar api here
              Route::get('/GetuserAvatar/{user_id}', function($user_id){
                  $user = User::where('id', $user_id)->first();
                  return response()->json([
                      'message' => 'success',
                      'user_avatar'=>$user->user_avatar,
                      ]);
              });
              Route::get('/UpdateuserAvatar/{user_id}/{avatar_id}', function($user_id, $avatar_id){
                  $user = User::where('id', $user_id)->first();
                  if($avatar_id > 2 || $avatar_id < 0){
                      return response()->json([
                          'message' => 'error',
                          'error'=>'Avatar value should be between 0,1 or 2',
                          ]);
                  }
                  $user->user_avatar = $avatar_id;
                  $user->save();
                  return response()->json([
                      'message' => 'success',
                      'user_avatar'=>$user->user_avatar,
                      ]);
              });
              //  End Here
            
            Route::get('/GetVendorById/{id}', function($id){
                  $user = Vendor::where('id', $id)->first();
                  return response()->json([
                      'message' => 'success',
                      'vendor'=>$user,
                      ]);
              });
            
            Route::prefix('contact_us/')->group(function () {
                Route::post('store', [ContactUsApiController::class, 'store']);
            });    
            
            
            

    // });
    
    
});