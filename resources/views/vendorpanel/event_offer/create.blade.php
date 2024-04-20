@extends('vendorpanel.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Add Offer Event') }}</h4>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              {{-- <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div> --}}

              <div class="alert alert-danger pb-1 d-none" id="eventErrors" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul></ul>
              </div>
              
             
              <form id="eventForm" action="{{ route('vendor.event_management.store_event') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                  <label for="">{{ __('Restaurant Logo') }}</label>
                  <br>
                  {{-- <div class="thumb-preview">
                    <img src="{{ asset('assets/img/noimage.jpg') }}"  alt="..." class="uploaded-img">
                  </div> --}}
                  <div class="thumb-preview">
                    <img
                      src="{{ $vendor->logo ? asset('assets/admin/img/vendor-photo/' . $vendor->logo) : asset('assets/admin/img/noimage.jpg') }}"
                      alt="..." class="uploaded-img" style="max-width: 100%; width: 200px;height: 150px;">
                    
                  </div>

                </div>
                
                <div class="form-group mt-2">
                    <label for="">{{ __('Media Content') }}</label>
                    <br>
                    <p class="text-warning">That will be shown in Vertaical Format.</p>
                    <br>
                    <div class="thumb-preview">
                        <div id="previews">
                             <img src="{{ asset('assets/img/noimage.jpg') }}" style="max-width: 100%; width: 200px;" alt="...">
                        </div>
                    </div>
                    <div class="mt-2">
                         <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Image, Video, or GIF') }}
                          <input type="file" accept="image/*,video/*,.gif" class="img-input-media" name="media_content" onchange="previewFiles()">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                     <label>{{ __('Resturant Title') . ' *' }}</label>
                     <input type="text" name="rest_title" readonly value="{{ $vendor->name }}" class="form-control" placeholder="Enter Restaurant Title"/> 
                   </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                      <label>{{ __('Offer Title') . ' *' }}</label>
                      <input type="text" name="offer_title" class="form-control" placeholder="Enter Offer Title"/> 
                    </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mt-3">
                    <label>{{ __('Description') . ' *' }}</label>
                    <input type="text" name="description" class="form-control" placeholder="Enter Description"/> 
                  </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                      <label>{{ __('Offer Options') . ' *' }}</label>
                      <select name="offer_type" class="form-control offer_options">
                        <option>{{ __('Selec Offer Options') }}</option>
                        <option value="old_new">{{ __('Old price/New Price') }}</option>
                        <option value="off">{{ __('%off') }}</option>
                        <option value="free">{{ __('free') }}</option>
                      </select>
                    </div> 
                </div> 
                <div class="col-lg-6">
                    <div class="form-group free d-none mt-3">
                                            
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group off d-none mt-3">
                      <div>
                        <label>{{ __('Off') . ' *' }}</label>
                          <input type="text" class="form-control" name="discount_amount" placeholder="Enter off">  
                      </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group old_new d-none mt-3">
                      <div>
                        <div>
                          <label>{{ __('Old Price') . ' *' }}</label>
                          <input type="text" name="old_price" class="form-control" placeholder="Enter Old Price">                    
                        </div>
                        <div class="mt-2">
                          <label>{{ __('New Price') . ' *' }}</label>
                          <input type="text" name="new_price" class="form-control" placeholder="Enter New Price">                    
                        </div>
                      </div>
                    </div>
                </div>
                
                  <div class="col-lg-6 mt-2">
                    <div class="form-group">
                      <label for="">{{ __('Enable/Disable') . '*' }}</label>
                      <select name="status" class="form-control">
                        <option selected disabled>{{ __('Select') }}</option>
                        <option value="1">{{ __('Enable') }}</option>
                        <option value="0">{{ __('Disable') }}</option>
                      </select>
                    </div>
                  </div> 

              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventOfferSubmit" class="btn btn-success">
                {{ __('Save') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script>
    // function previewFiles() {
    //     var preview = document.getElementById('previews');
    //     preview.innerHTML = '';

    //     var files = document.querySelector('input[type=file]').files;
    //     for (var i = 0; i < files.length; i++) {
    //         var file = files[i];
    //         var reader = new FileReader();

    //         reader.onloadend = function () {
    //             var fileType = file.type.split('/')[0];
    //             var media;

    //             if (fileType === 'image') {
    //                 media = '<img src="' + reader.result + '" style="max-width: 100%; width: 200px;">'; // Set width for images
    //             } else if (fileType === 'video') {
    //                 media = '<video controls style="max-width: 100%; width: 200px;"><source src="' + reader.result + '" type="' + file.type + '"></video>'; // Set width for videos
    //             } else if (fileType === 'application' && file.type === 'image/gif') {
    //                 media = '<img src="' + reader.result + '" style="max-width: 100%; width: 200px;">'; // Set width for GIFs
    //             } else {
    //                 media = '<p>Preview not supported</p>';
    //             }

    //             var div = document.createElement('div');
    //             div.innerHTML = media;
    //             preview.appendChild(div);
    //         };

    //         reader.readAsDataURL(file);
    //     }
    // }
    
    function previewFiles() {
        var preview = document.getElementById('previews');
        preview.innerHTML = '';

        var files = document.querySelector('input[type=file]').files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onloadstart = function () {
                // Show loader
                var loader = document.createElement('div');
                loader.className = 'loader';
                loader.innerHTML = 'Loading...';
                preview.appendChild(loader);
            };

            reader.onload = function (e) {
                var fileType = file.type.split('/')[0];
                var media;

                if (fileType === 'image') {
                    media = '<img src="' + e.target.result + '" style="max-width: 100%; width: 200px;">'; // Set width for images
                } else if (fileType === 'video') {
                    media = '<video controls style="max-width: 100%; width: 200px;"><source src="' + e.target.result + '" type="' + file.type + '"></video>'; // Set width for videos
                } else if (fileType === 'application' && file.type === 'image/gif') {
                    media = '<img src="' + e.target.result + '" style="max-width: 100%; width: 200px;">'; // Set width for GIFs
                } else {
                    media = '<p>Preview not supported</p>';
                }

                var div = document.createElement('div');
                div.innerHTML = media;
                preview.appendChild(div);

                // Remove loader
                var loader = preview.querySelector('.loader');
                if (loader) {
                    loader.remove();
                }
            };

            reader.readAsDataURL(file);
        }
    }

</script>



  <script type="text/javascript" src="{{ asset('assets/admin/js/admin-partial.js') }}"></script>
  
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

