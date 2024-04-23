<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Vendor\LoginSecurityController;
use App\Http\Controllers\Backend\Vendor\EventOfferController;

use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| User Interface Routes
|--------------------------------------------------------------------------
*/

Route::get('/clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});





Route::get('vendor/email/verify', 'BackEnd\Vendor\VendorController@confirm_email');
Route::prefix('/vendor')->group(function () {
  

// Enable 2fa 
  Route::group(['prefix'=>'2fa'], function(){
    Route::get('/', [LoginSecurityController::class,'show2faForm'])->name('show2faForm');
    Route::post('/generateSecret', [LoginSecurityController::class,'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa', [LoginSecurityController::class,'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [LoginSecurityController::class,'disable2fa'])->name('disable2fa');
 

    // 2fa middleware
    Route::post('/2faVerify', function () {
      return redirect()->route('vendor.dashboard');
        
    })->name('2faVerify')->middleware(['auth:vendor', '2fa']);

    
});






// test middleware
Route::get('/vendor_2fa', function () {
  return redirect()->route('vendor.dashboard');
})->middleware(['auth:vendor', '2fa']);


Route::get('check', function (){
  return redirect()->route('vendor.dashboard');
})->middleware(['auth:vendor', '2fa']);


  Route::middleware('guest:vendor')->group(function () {
    Route::get('/welcome', [VendorController::class,'welcome'])->name('vendor.welcome');;
    Route::get('/login', [VendorController::class,'login'])->name('vendor.login');
    Route::get('/reset-password', [VendorController::class,'resetPassword'])->name('vendor.resetPassword');
    // Route::get('/email_verfication', [VendorController::class,'email_verfication'])->name('vendor.email_verfication');
    
    //  Route::get('/login', function(){
    //      dd("enter");
    //  });
    Route::get('/signup', [VendorController::class,'signup'])->name('vendor.signup');
    Route::post('/create', [VendorController::class,'create'])->name('vendor.create');
    Route::post('/store', [VendorController::class,'authentication'])->name('vendor.authentication');
 
  });

  Route::get('/logout', [VendorController::class,'logout'])->name('vendor.logout');
  Route::get('/change-password', [VendorController::class,'change_password'])->name('vendor.change.password');
  Route::post('/update-password', [VendorController::class,'updated_password'])->name('vendor.update_password');
});


Route::prefix('/vendor')->middleware('auth:vendor', 'verified')->group(function () {
  Route::get('/dashboard', [VendorController::class,'index'])->name('vendor.dashboard');

    
   
  Route::get('/event-offer-management/events', [EventOfferController::class,'index'])->name('vendor.event_management.event');
  Route::get('/add-event-offer',[EventOfferController::class,'add_event'])->name('add.event.event');

  Route::post('/event-offer-store', [EventOfferController::class,'store'])->name('vendor.event_management.store_event');
  Route::post('/event-offer/{id}/update-status', [EventOfferController::class,'updateStatus'])->name('vendor.event_management.event.event_status');
  Route::post('/event-offer/{id}/update-featured', [EventOfferController::class,'updateFeatured'])->name('vendor.event_management.event.update_featured');
  Route::post('/delete-event-offer/{id}', [EventOfferController::class,'destroy'])->name('vendor.event_management.delete_event');
  Route::get('/edit-event-offer', [EventOfferController::class,'edit'])->name('vendor.event_management.edit_event');
//   Route::get('/edit-event-offer/{id}', [EventOfferController::class,'edit'])->name('vendor.event_management.edit_event');

  Route::post('/event-offer-update', [EventOfferController::class,'update'])->name('vendor.event.update');
  Route::get('/delete-offer-media/{id}', [EventOfferController::class,'remove_media'])->name('vendor.offer.remove_media');
  Route::post('/bulk/delete/event-offer',[EventOfferController::class,'bulk_delete'])->name('vendor.event_management.bulk_delete_event');








});



require __DIR__.'/auth.php';
