@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Edit Event Popup') }}</h4>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">

              <div class="alert alert-danger pb-1 d-none" id="eventErrors" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul></ul>
              </div>
              
             
              <form id="eventForm" action="{{ route('admin.event_popup.update_event_popup') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                {{-- offer_options --}}
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                      <label>{{ __('Event Popup Options') . ' *' }}</label>
                      <select name="popup_type" class="form-control popup_options">
                        <option>{{ __('Select Popup Options') }}</option>
                        <option value="simple_popup" {{ $event->popup_type=="simple_popup" ? "selected" : "" }}>{{ __('Simple Popup') }}</option>
                        <option value="flyer_popup" {{ $event->popup_type=="flyer_popup" ? "selected" : "" }}>{{ __('Flyer Popup') }}</option>
                      </select>
                    </div> 
                </div> 
                <div class="col-lg-6">
                    <div class="form-group simple_popup {{ $event->popup_type=="simple_popup" ? "":"d-none" }} mt-3">
                      <div class="form-group">
                        <label for="">{{ __('Circle Picture') }}</label>
                        <br>
                        <div class="thumb-preview">
                          <img src="{{ isset($event->circle_pic) ? asset('assets/admin/img/event-popup/'.$event->circle_pic)  : asset('assets/img/noimage.jpg') }}" width="150px" alt="..." class="uploaded-img">
                        </div>
      
                        <div class="mt-3">
                          <div role="button" class="btn btn-primary btn-sm upload-btn">
                            {{ __('Choose Circle Picture') }}
                            <input type="file" accept="image/*" width="150px" class="img-input" name="circle_picture">
                          </div>
                        </div>
                      </div>
       
                      <div class="col-lg-6">
                        <div class="form-group">
                           <label>{{ __('Title') . ' *' }}</label>
                           <input type="text" name="title" value="{{ $event->title }}" class="form-control" placeholder="Enter Text"/> 
                         </div>
                      </div>
                      
                   
                      <div class="col-lg-6">
                        <div class="form-group mt-3">
                          <label>{{ __('Description') . ' *' }}</label>
                          <input type="text" name="description" value="{{ $event->description }}" class="form-control" placeholder="Enter Description"/> 
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group flyer_popup {{ $event->popup_type=="flyer_popup" ? "":"d-none" }} mt-3">
                        <div class="form-group">
                          <label for="">{{ __('Flyer Pic') }}</label>
                          <br>
                          <div class="thumb-preview">
                            <img src="{{ isset($event->flyer_pic) ? asset('assets/admin/img/event-popup/'.$event->flyer_pic)  : asset('assets/img/noimage.jpg') }}" width="150px" alt="..." class="uploaded-img2">
                          </div>
        
                          <div class="mt-3">
                            <div role="button" class="btn btn-primary btn-sm upload-btn">
                              {{ __('Choose Flyer Pic') }}
                              <input type="file" accept="image/*" class="img-input2" name="flyer_pic">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-primary">
                {{ __('Update') }}
              </button>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

  {{-- <script type="text/javascript" src="{{ asset('assets/admin/js/admin-partial.js') }}"></script> --}}
  
  {{-- <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script> --}}
@endsection

@section('variables')
  <script>
    "use strict";
   
    var loadImgs = 0;
  </script>
@endsection

