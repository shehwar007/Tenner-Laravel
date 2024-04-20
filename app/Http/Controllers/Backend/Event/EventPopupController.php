<?php

namespace App\Http\Controllers\BackEnd\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\EventOffer;
use App\Models\EventOffer\EventPopup;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventPopupController extends Controller
{
  //index
  public function index(Request $request)
  {
    $events = EventPopup::get();
    $information['events'] = $events;
    return view('backend.tenner-popup.index', $information);
  }

  public function create()
  {
    // $information = [];
    // $organizers = Vendor::get();
    // $information['organizers'] = $organizers;

    return view('backend.tenner-popup.create');
  }

  

  public function store(Request $request)
  {
    DB::transaction(function () use ($request) {

      $in = $request->all();     
      if ($request->hasFile('circle_picture')) {
        $img = $request->file('circle_picture');
        $filename = uniqid().'.'.$img->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/event-popup/');
        @mkdir($directory, 0775, true);
        $request->file('circle_picture')->move($directory, $filename);
        $in['circle_pic'] = $filename;
      }

      if ($request->hasFile('flyer_pic')) {
        $img2 = $request->file('flyer_pic');
        $filename2 = uniqid().'.'.$img2->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/event-popup/');
        @mkdir($directory, 0775, true);
        $request->file('flyer_pic')->move($directory, $filename2);
        $in['flyer_pic'] = $filename2;
      }

      $eventOffer = EventPopup::create($in);

    });
    Session::flash('success', 'Added Successfully');
      $status = [
        'status'=>'success',
        'redirect_url'=>route('admin.event_popup')
      ];
    return response()->json($status, 200);
  }

  /**
   * Update featured status of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  
  public function edit($id)
  {
    $event = EventPopup::findOrFail($id);
    $information['event'] = $event;
    return view('backend.tenner-popup.edit', $information);
  }
  
  

  // public function update(UpdateRequest $request)
  public function update(Request $request)
  {

    $in = $request->all();
    
      if($request->popup_type == "flyer_popup"){
        $in['title'] = null;
        $in['description'] = null;
      }

    $event = EventPopup::where('id',$request->event_id)->first();
    
    if ($request->hasFile('circle_picture')) {
      @unlink(public_path('assets/admin/img/event-popup/').$event->flyer_pic);
      @unlink(public_path('assets/admin/img/event-popup/').$event->circle_pic);
       
        $img = $request->file('circle_picture');
        $filename = uniqid() . '.' . $img->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/event-popup/');
        @mkdir($directory, 0775, true);
        $request->file('circle_picture')->move($directory, $filename);
        $in['circle_pic'] = $filename;
        $in['flyer_pic'] = null;
      }

      if ($request->hasFile('flyer_pic')) {
          @unlink(public_path('assets/admin/img/event-popup/').$event->flyer_pic);
          @unlink(public_path('assets/admin/img/event-popup/').$event->circle_pic);
         
        // @unlink(public_path('assets/admin/img/event-popup/') . $event->flyer_pic);
        $img2 = $request->file('flyer_pic');
        $filename2 = uniqid() . '.' . $img2->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/event-popup/');
        @mkdir($directory, 0775, true);
        $request->file('flyer_pic')->move($directory, $filename2);
        $in['flyer_pic'] = $filename2;
        $in['circle_pic'] = null;
      }
    
    $event = EventPopup::where('id', $event->id)->first();
   
    $event->update($in);
    Session::flash('success', 'Updated Successfully');

    $status = [
      'status'=>'success',
      'redirect_url'=>route('admin.event_popup')
    ];
    return response()->json($status, 200);    
    // return response()->json(['status' => 'success'], 200);
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $event = EventPopup::find($id);
    
    isset($event->flyer_pic) ?  @unlink(public_path('assets/admin/img/event-popup/') . $event->flyer_pic):'';
    isset($event->circle_picture)? @unlink(public_path('assets/admin/img/event-popup/') . $event->circle_picture):'';

    // finally delete the event
    $event->delete();

    return redirect()->back()->with('success', 'Deleted Successfully');
  }
  
}
