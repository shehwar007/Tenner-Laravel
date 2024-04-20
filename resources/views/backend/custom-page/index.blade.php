@extends('backend.layout')

@section('content')
 
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
          <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.custom_pages.edit_page')}}">
            {{ __('update Terms And Condition') }}
          </a>
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Terms And Condition List</h6>
            </div>
          </div>
        
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table table-striped mt-3" id="custompages-datatables">
                <thead>
                  <tr>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($pages))
                  @foreach ($pages as $page)
                    <tr>
                      <td>{{ 'Terms & Condition' }}</td>
                     
                          <td class="text-center">
                            <div>
                              <!--<a href="{{ route('admin.custom_pages.edit_page', ['id' => $page->id]) }}"-->
                              <a href="{{ route('admin.custom_pages.edit_page')}}"
                              class="btn btn-primary">
                              {{ __('Edit') }}
                              </a>
                      
                          <form class="deleteForm"
                              action={{ route('admin.custom_pages.delete_page', ['id' => $page->id]) }}
                              method="post" style="display:inline-block;">
                              @csrf
                                @method('DELETE')
                              <button type="submit" class="btn btn-danger deleteBtn">
                                {{ __('Delete')}}
                              </button>
                          </form> 
                        </td>
                    </tr>
                  @endforeach 
                  @endif 
                </tbody>
              </table>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
