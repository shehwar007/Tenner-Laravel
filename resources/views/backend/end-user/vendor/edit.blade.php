@extends('backend.layout')

@section('content')

  <div class="row">
    <div class="col-md-12">
         <div style="text-align: right;">
          <a class="btn btn-info btn-sm float-right d-inline-block mr-2"
            href="{{ route('admin.vendor_management.registered_vendor') }}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            {{ __('Back') }}
          </a>
        </div>
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-8">
                  <div class="card-title">{{ __('Edit vendor') }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto" style="margin-top: -88px;">
              <div class="alert pb-1 dis-none" id="eventErrors">
                {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                <ul></ul>
              </div>
              <form id="eventForm"
                action="{{ route('admin.vendor_management.vendor.update_vendor', $vendor->id) }}"
                method="post" enctype="multipart/form-data"> 
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">{{ __('Logo') . '*' }}</label>
                      <br>
                      <div class="thumb-preview">
                        @if ($vendor->logo != null)
                          <img src="{{ asset('assets/admin/img/vendor-photo/' . $vendor->logo) }}" width="150px" alt="..."
                            class="uploaded-img">
                        @else
                          <img src="{{ asset('assets/admin/img/noimage.jpg') }}" alt="..." width="150px" class="uploaded-img">
                        @endif

                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Logo') }}
                          <input type="file" accept="image/*"  class="img-input" name="logo">
                        </div>
                        @if ($errors->has('logo'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('logo') }}</p>
                        @endif
                        <p id="editErr_logo" class="mt-1 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Email'). " *" }}</label>
                      <input type="text" value="{{ $vendor->email }}" class="form-control" name="email">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Company Name'). " *" }}</label>
                      <input type="text" value="{{ $vendor->name }}" class="form-control" name="name">
                      <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Address'). " *" }}</label>
                      <input type="text" value="{{ $vendor->address }}" class="form-control" name="address">
                      <p id="editErr_address" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('phone') . ' *' }}</label>
                      <input type="text" value="{{ isset($vendor->phone) ? $vendor->phone: "" }}" class="form-control" name="phone"
                      placeholder="{{ __('Enter Phone') }}">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
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
              <button type="submit" id="EventSubmit" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
