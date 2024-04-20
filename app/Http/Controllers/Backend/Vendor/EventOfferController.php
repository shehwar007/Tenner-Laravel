<?php

namespace App\Http\Controllers\BackEnd\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\EventOffer;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EventOfferController extends Controller
{
  //index
  public function index(Request $request)
  {
    // $events = Event::join('event_contents', 'event_contents.event_id', '=', 'events.id')
    //   ->join('event_categories', 'event_categories.id', '=', 'event_contents.event_category_id')
      
    //   ->when($title, function ($query) use ($title) {
    //     return $query->where('event_contents.title', 'like', '%' . $title . '%');
    //   })
    //   ->when($event_type, function ($query) use ($event_type) {
    //     return $query->where('events.event_type', $event_type);
    //   })
    //   ->select('events.*', 'event_contents.id as eventInfoId', 'event_contents.title', 'event_contents.slug', 'event_categories.name as category')
    //   ->orderByDesc('events.id')
    //   ->paginate(10);

    $events = EventOffer::where('vendor_id',Auth::guard('vendor')->user()->id)->get();
    $information['events'] = $events;
    return view('vendorpanel.event_offer.index', $information);
  }

  public function add_event()
  {
    $information = [];

    $vendor = Vendor::select('id','name','logo')->where('id',Auth::guard('vendor')->user()->id)->first();
    $information['vendor'] = $vendor;
      
    return view('vendorpanel.event_offer.create',$information);
  }

  

  public function store(Request $request)
  {
    $request->validate([
        'offer_title' => 'required',
        'description' => 'required',
        'status' => 'required',
        'offer_type' => 'required',
    ]);
    
    // Get the MIME type of the file
    DB::transaction(function () use ($request) {
    
        $in = $request->all();
        if ($request->hasFile('media_content')) {
                 $rules = [
                  'media_content' => 'file|mimes:jpeg,png,gif,mp4',
                 ];
            
                $validator = Validator::make($request->all(), $rules);
            
               if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
            
            $mimeType = $request->file('media_content')->getMimeType();
            
            $img = $request->file('media_content');
           if ($request->hasFile('media_content')) {
             $filename = time() . '.' . $img->getClientOriginalExtension();
             $directory = public_path('assets/admin/img/vendor-photo/media-content/');
             @mkdir($directory, 0775, true);
             $request->file('media_content')->move($directory, $filename);
             $in['media_content'] = $filename;
             $in['media_type'] = $mimeType;
           }
        }
      $in['vendor_id'] = Auth::guard('vendor')->user()->id;
     
      

      $in['r_logo'] = Auth::guard('vendor')->user()->logo;



    
      $eventOffer = EventOffer::create($in);

    });
    
    Session::flash('success', 'Added Successfully');
    
    $status = [
          'status' => 'success',
          'redirect_url' => route('vendor.event_management.event'),
      ];
    
    // return response()->json(['status' => 'success'], 200);
    return response()->json($status, 200);
  }

  
  /**
   * Update status (active/DeActive) of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateStatus(Request $request, $id)
  {
    $event = EventOffer::find($id);

    $event->update([
      'status' => $request['status']
    ]);
    Session::flash('success', 'Update Status Successfully');

    return redirect()->back();
  }
  /**
   * Update featured status of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateFeatured(Request $request, $id)
  {
    $event = EventOffer::find($id);

    if ($request['is_featured'] == 'yes') {
      $event->is_featured = 'yes';
      $event->save();

      Session::flash('success', 'Updated Successfully');
    } else {
      $event->is_featured = 'no';
      $event->save();

      Session::flash('success', 'Updated Successfully');
    }

    return redirect()->back();
  }

//   public function edit($id)
//   {
//     $vendor = Vendor::select('id','name','logo')->where('id',Auth::guard('vendor')->user()->id)->first();
//     $information['vendor'] = $vendor;
//     $event = EventOffer::findOrFail($id);
    
//     $information['event'] = $event;
  
//     // $organizers = Vendor::get();
//     // $information['organizers'] = $organizers;

//     return view('vendorpanel.event_offer.edit', $information);
//   }
  
  public function edit()
  {
    $vendor = Vendor::select('id','name','logo')->where('id',Auth::guard('vendor')->user()->id)->first();
    $information['vendor'] = $vendor;
    $event = EventOffer::where('vendor_id',Auth::guard('vendor')->user()->id)->first();
    $information['event'] = $event;
    return view('vendorpanel.event_offer.edit', $information);
  }
  
  

  // public function update(UpdateRequest $request)
  public function update(Request $request)
  {
      $request->validate([
            'offer_title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'offer_type' => 'required',
        ]);
    
      if($request->event_id == ""){
                   DB::transaction(function () use ($request) {
            
                $in = $request->all();
                if ($request->hasFile('media_content')) {
                         $rules = [
                          'media_content' => 'file',
                         ];
                    
                        $validator = Validator::make($request->all(), $rules);
                    
                       if ($validator->fails()) {
                            return response()->json(['errors' => $validator->errors()], 422);
                        }

                    $allowedMimeTypes = [
                        // Images
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'image/bmp',
                        'image/webp',
                    
                        // Videos
                        'video/mp4',
                        'video/quicktime',
                        'video/x-msvideo',
                        'video/x-ms-wmv',
                        'video/x-matroska',
                        'video/x-flv',
                        'video/mpeg',
                        'video/x-m4v',
                        'video/webm',
                    ];
            
            
            
                    $mimeType = strtolower($request->file('media_content')->getMimeType());
        
                    if(!in_array($mimeType, $allowedMimeTypes)){
                        return response()->json(['errors' => ['media_content'=>'File Type Not Allowed']], 400);
                    };
                    
                    $img = $request->file('media_content');
                   if ($request->hasFile('media_content')) {
                     $filename = time() . '.' . $img->getClientOriginalExtension();
                     $directory = public_path('assets/admin/img/vendor-photo/media-content/');
                     @mkdir($directory, 0775, true);
                     $request->file('media_content')->move($directory, $filename);
                     $in['media_content'] = $filename;
                     $in['media_type'] = $mimeType;
                   }
                }
              $in['vendor_id'] = Auth::guard('vendor')->user()->id;
             
              $in['r_logo'] = Auth::guard('vendor')->user()->logo;
        
              $eventOffer = EventOffer::create($in);
        
            });
            
            Session::flash('success', 'Added Successfully');
            
            $status = [
                  'status' => 'success',
                  'redirect_url' => route('vendor.event_management.event'),
              ];
            
            // return response()->json(['status' => 'success'], 200);
            return response()->json($status, 200);
      }   
      else{
            $in = $request->all();
                $in['vendor_id'] = Auth::guard('vendor')->user()->id;
               
                $event = EventOffer::where('id', $request->event_id)->first();
                
                      if ($request->hasFile('media_content')) {
                          
                         $rules = [
                          'media_content' => 'file',
                         ];
                    
                        $validator = Validator::make($request->all(), $rules);
                    
                       if ($validator->fails()) {
                            return response()->json(['errors' => $validator->errors()], 422);
                        }
                       

                    $allowedMimeTypes = [
                        // Images
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'image/bmp',
                        'image/webp',
                    
                        // Videos
                        'video/mp4',
                        'video/quicktime',
                        'video/x-msvideo',
                        'video/x-ms-wmv',
                        'video/x-matroska',
                        'video/x-flv',
                        'video/mpeg',
                        'video/x-m4v',
                        'video/webm',
                    ];
            
            
            
                    $mimeType = strtolower($request->file('media_content')->getMimeType());
                        
                        $img = $request->file('media_content');
                       if ($request->hasFile('media_content')) {
                         @unlink(public_path('assets/admin/img/vendor-photo/media-content/') . $event->media_content);
                         $filename = time() . '.' . $img->getClientOriginalExtension();
                         $directory = public_path('assets/admin/img/vendor-photo/media-content/');
                         @mkdir($directory, 0775, true);
                         $request->file('media_content')->move($directory, $filename);
                         $in['media_content'] = $filename;
                         $in['media_type'] = $mimeType;
                       }
                    }
                   
                
            
                $in['r_logo'] = Auth::guard('vendor')->user()->logo;
            
            
                // $in['vendor_id'] = Auth::guard('admin')->user()->id;
                // dd($in);
                $event = EventOffer::where('id', $event->id)->first();
            
                $event->update($in);
                Session::flash('success', 'Updated Successfully');
            
            $status = [
                  'status' => 'success',
                  'redirect_url' => route('vendor.event_management.event'),
              ];
            
            // return response()->json(['status' => 'success'], 200);
            return response()->json($status, 200);
                // return response()->json(['status' => 'success'], 200);
      }
    
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function remove_media($id)
  {
    $event = EventOffer::find($id);

    @unlink(public_path('assets/admin/img/vendor-photo/media-content/') . $event->media_content);     

    $event->media_content = null;
    $event->media_type = null;
    $event->save();
    
    return redirect()->back()->with('success', 'Media Removed Successfully');
  }
  public function destroy($id)
  {
    $event = EventOffer::find($id);

    // @unlink(public_path('assets/admin/img/vendor-photo/') . $event->r_logo);
    @unlink(public_path('assets/admin/img/vendor-photo/media-content/') . $event->media_content);     

    // finally delete the event
    $event->delete();

    return redirect()->back()->with('success', 'Deleted Successfully');
  }
  //bulk_delete
  public function bulk_delete(Request $request)
  {
    foreach ($request->ids as $id) {
      $event = EventOffer::find($id);
      @unlink(public_path('assets/admin/img/vendor-photo/') . $event->r_logo);
      $event->delete();
    }
    Session::flash('success', 'Deleted Successfully');
    return response()->json(['status' => 'success'], 200);
  }
}
