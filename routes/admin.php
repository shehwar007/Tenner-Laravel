<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Vendor\VendorManagementController;
use App\Http\Controllers\Backend\LoginSecurityController;
use App\Http\Controllers\Backend\Event\EventOfferController;
use App\Http\Controllers\Backend\Event\EventPopupController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\Administrator\SiteAdminController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\CustomPageController;
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

Route::prefix('/admin')->middleware(['auth:admin'])->group(function () {
// admin redirect to dashboard route
    Route::get('/dashboard', [AdminController::class,'redirectToDashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');



    // Enable 2fa 
    Route::group(['prefix'=>'2fa'], function(){
    Route::get('/', [LoginSecurityController::class,'show2faForm'])->name('show2faForm');
    Route::post('/generateSecret', [LoginSecurityController::class,'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa', [LoginSecurityController::class,'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [LoginSecurityController::class,'disable2fa'])->name('disable2fa');
 

    // 2fa middleware
    Route::post('/2faVerify', function () {
      return redirect()->route('admin.dashboard');
        
    })->name('2faVerify')->middleware(['auth:admin', '2fa']);




    
});


    // test middleware
    Route::get('/admin_2fa', function () {
  
      return redirect()->route('admin.dashboard');
    })->middleware(['auth:admin', '2fa']);

    // ->middleware(['auth:admin', '2fa'])
    Route::get('check', function (){
      return redirect()->route('admin.dashboard');
    })->middleware(['auth:admin', '2fa']);


  //  Event Offers
    // Route::group([], function () {
      Route::get('event-offer-management/events', [EventOfferController::class,'index'])->name('admin.event_management.event');
      Route::get('add-event-offer',[EventOfferController::class,'add_event'])->name('admin.add.event.event');
    
      Route::post('event-offer-store', [EventOfferController::class,'store'])->name('admin.event_management.store_event');
      Route::post('/event-offer/{id}/update-status', [EventOfferController::class,'updateStatus'])->name('admin.event_management.event.event_status');
      Route::post('/event-offer/{id}/update-featured', [EventOfferController::class,'updateFeatured'])->name('admin.event_management.event.update_featured');
      Route::post('/delete-event-offer/{id}', [EventOfferController::class,'destroy'])->name('admin.event_management.delete_event');
      Route::get('/edit-event-offer/{id}', [EventOfferController::class,'edit'])->name('admin.event_management.edit_event');
     
      Route::post('/event-offer-update', [EventOfferController::class,'update'])->name('admin.event.update');
      Route::get('/delete-offer-media/{id}', [EventOfferController::class,'remove_media'])->name('admin.offer.remove_media');
      Route::post('bulk/delete/event-offer',[EventOfferController::class,'bulk_delete'])->name('admin.event_management.bulk_delete_event');
    // });
   
    // Event Offers End Here


    // Tenner Event Popup route start
  Route::prefix('/event-popup')->group(function () {
    Route::get('',[EventPopupController::class,'index'])->name('admin.event_popup');

    Route::get('/create-event-popup', [EventPopupController::class,'create'])->name('admin.event_popup.create_event_popup');

    Route::post('/store-event-popup', [EventPopupController::class,'store'])->name('admin.event_popup.store_event_popup');

    Route::get('/edit-event-popup/{id}', [EventPopupController::class,'edit'])->name('admin.event_popup.edit_event_popup');

    Route::post('/update-event-popup', [EventPopupController::class,'update'])->name('admin.event_popup.update_event_popup');

    Route::delete('/delete-event-popup/{id}', [EventPopupController::class,'destroy'])->name('admin.event_popup.delete_event_popup');

  });
  // Tenner Event Popup route route end



        // custom-pages route start
  Route::prefix('/term-condition')->group(function () {
    Route::get('',[CustomPageController::class,'index'])->name('admin.custom_pages');

    // Route::get('/create-page', [CustomPageController::class,'create'])->name('admin.custom_pages.create_page');

    Route::post('/store-page', [CustomPageController::class,'store'])->name('admin.custom_pages.store_page');

    // Route::get('/edit-page/{id}', [CustomPageController::class,'edit'])->name('admin.custom_pages.edit_page');
    Route::get('/edit-page', [CustomPageController::class,'edit'])->name('admin.custom_pages.edit_page');

    Route::post('/update-page', [CustomPageController::class,'update'])->name('admin.custom_pages.update_page');
    // Route::post('/update-page/{id}', [CustomPageController::class,'update'])->name('admin.custom_pages.update_page');

    Route::delete('/delete-page/{id}', [CustomPageController::class,'destroy'])->name('admin.custom_pages.delete_page');

  });
  // custom-pages route end
  
   // contact-us route start
    Route::prefix('/contact-us')->group(function () {
      Route::get('',[ContactUsController::class,'index'])->name('admin.contact_us');
      Route::delete('/delete-page/{id}', [ContactUsController::class,'destroy'])->name('admin.contact_us.delete');
    });
  // contact-us route end
      












    // Vendor management route start
  Route::prefix('/vendor-management')->group(function () {

    // Route::get('/add-organzer', 'BackEnd\Organizer\OrganizerManagementController@add')->name('admin.user_management.add_organizer');
    // Route::post('/save-organzer', 'BackEnd\Organizer\OrganizerManagementController@create')->name('admin.user_management.save-organizer');

    Route::get('/registered-vendors',[VendorManagementController::class,'index'])->name('admin.vendor_management.registered_vendor');
    Route::get('/get-vendors', [VendorManagementController::class,'get_vendor'])->name('admin.vendor_management.get_vendor');

    Route::prefix('/vendor/{id}')->group(function () {
    Route::get('/edit', [VendorManagementController::class,'edit'])->name('admin.edit_management.vendor_edit');
    
    Route::post('/update', [VendorManagementController::class,'update'])->name('admin.vendor_management.vendor.update_vendor');
        // Route::post('/update-password', 'BackEnd\Vendor\VendorManagementController@updatePassword')->name('admin.vendor_management.vendor.update_password');
    
    Route::post('/delete', [VendorManagementController::class,'destroy'])->name('admin.vendor_management.vendor.delete');
      // Route::post('/update-email-status', 'BackEnd\Vendor\VendorManagementController@updateEmailStatus')->name('admin.user_management.organizer.update_email_status');

      Route::post('/update-vendor-account-status', [VendorManagementController::class,'updateAccountStatus'])->name('admin.vendor_management.vendor.update_account_status');

    //   Route::get('/details', 'BackEnd\Vendor\VendorManagementController@show')->name('admin.user_management.organizer_details');


    //   Route::get('/change-password', 'BackEnd\Vendor\VendorManagementController@changePassword')->name('admin.user_management.organizer.change_password');


    //   Route::get('/secret-login', 'BackEnd\Vendor\VendorManagementController@secret_login')->name('admin.user_management.organizer.secret_login');
    });
   
  });
  // Vendor management route end


   //  User Management Route Start
  Route::prefix('/user-management')->group(function () {

    Route::get('/registered-user', [UserManagementController::class,'index'])->name('admin.user_management.registered_user');
    Route::get('/get-user', [UserManagementController::class,'get_user'])->name('admin.user_management.get_user');
    Route::get('/add-user', [UserManagementController::class,'create'])->name('admin.user_management.add_user');

    Route::post('/store-user', [UserManagementController::class,'store'])->name('admin.user_management.store_user');

    Route::prefix('/favourite')->group(function () {
      Route::get('/event-offer', [UserManagementController::class,'fav_list'])->name('admin.user_management.favourite_user.eventoffer');  
    });

    Route::prefix('/user/{id}')->group(function () {
      Route::post('/update-email-status', [UserManagementController::class,'updateEmailStatus'])->name('admin.user_management.user.update_email_status');

      Route::post('/update-account-status', [UserManagementController::class,'updateAccountStatus'])->name('admin.user_management.user.update_account_status');

      Route::get('/details', [UserManagementController::class,'show'])->name('admin.user_management.user_details');

      Route::get('/edit', [UserManagementController::class,'edit'])->name('admin.user_management.user_edit');

      Route::post('/update', [UserManagementController::class,'update'])->name('admin.user_management.user.update_user');

      Route::get('/change-password', [UserManagementController::class,'changePassword'])->name('admin.user_management.user.change_password');

      Route::post('/update-password', [UserManagementController::class,'updatePassword'])->name('admin.user_management.user.update_password');

      Route::post('/user-delete', [UserManagementController::class,'destroy'])->name('admin.user_management.user_delete');

      Route::get('/secret-login', [UserManagementController::class,'secret_login'])->name('admin.user_management.secret_login');
    });
  });

  // End Here 

   // admin management route start
   Route::prefix('/admin-management')->group(function () {
    
    Route::get('/registered-admins', [SiteAdminController::class,'index'])->name('admin.admin_management.registered_admins');
    Route::get('/get-registered-admins-data', [SiteAdminController::class,'get_registers_admin'])->name('admin.admin_management.get_registered_admins_data');

    Route::post('/store-admin', [SiteAdminController::class,'store'])->name('admin.admin_management.store_admin');

    Route::post('/admin/{id}/update-status', [SiteAdminController::class,'updateStatus'])->name('admin.admin_management.admin.update_status');

    Route::post('/update-admin', [SiteAdminController::class,'update'])->name('admin.admin_management.update_admin');

    Route::post('/delete-admin/{id}', [SiteAdminController::class,'destroy'])->name('admin.admin_management.delete_admin');
  });
  // admin management route end

});




