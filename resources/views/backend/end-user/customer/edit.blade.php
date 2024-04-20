@extends('backend.layout')

@section('content')
  
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">

              <div class="row">
                <div class="col-lg-8">
                  <div class="card-title">{{ __('Edit User') }}</div>
                </div>
                <div class="col-lg-4">
                  <a class="btn btn-info btn-sm float-right d-inline-block mr-2"
                    href="{{ route('admin.user_management.registered_user') }}">
                    <span class="btn-label">
                      <i class="fas fa-backward"></i>
                    </span>
                    {{ __('Back') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form id="ajaxEditForm"
                action="{{ route('admin.user_management.user.update_user', ['id' => $user->id]) }}"
                method="post">
                @csrf
                <div class="row">
                 
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('First Name')." *" }}</label>
                      <input type="text" value="{{ $user->fname }}" class="form-control" name="fname">
                      <p id="editErr_fname" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Last Name'). " *" }}</label>
                      <input type="text" value="{{ $user->lname }}" class="form-control" name="lname">
                      <p id="editErr_lname" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>{{ __('Email')." *" }}</label>
                      <input type="text" value="{{ $user->email }}" class="form-control" name="email">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
  
                </div>
              </form>
            </div>
            <div class="col-lg-6">

            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="updateBtn" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
