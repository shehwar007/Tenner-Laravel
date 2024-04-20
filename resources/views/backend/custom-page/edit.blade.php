@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Update Term & Condition') }}</h4>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
         
              {{-- <div class="alert alert-danger pb-1 d-none" id="eventErrors" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul></ul>
              </div> --}}

              <div class="alert pb-1 d-none" id="pageErrors" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul></ul>
              </div>
              <!--<form id="pageForm" action="{{ route('admin.custom_pages.update_page', ['id' => $page->id]) }}"-->
              <form id="pageForm" action="{{ route('admin.custom_pages.update_page') }}"
                method="POST">
                @csrf
                 <input type="hidden" name="page_id" value="{{ isset($page) ? $page->id:'' }}">
               
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="form-group">
                            <label>{{ __('Content') . ' *' }}</label>
                            <textarea id="descriptionTmce" class="form-control" name="content"
                                data-height="300">{{ isset($page) ? $page->content:'' }}</textarea>
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
                <button type="submit" form="pageForm" class="btn btn-success">
                    {{ __('Update') }}
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

