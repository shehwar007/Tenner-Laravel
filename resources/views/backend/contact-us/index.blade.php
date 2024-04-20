@extends('backend.layout')

@section('content')
 
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Contact List</h6>
            </div>
          </div>
        
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table table-striped mt-3" id="custompages-datatables">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">{{ __('Name') }}</th>
                    <th class="text-center" scope="col">{{ __('User Query') }}</th>
                    <th class="text-center" scope="col">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($contacts))
                  @foreach ($contacts as $contact)
                     @php
                      $users = DB::table('users')->where('id',$contact->user_id)->first();
                     @endphp 
                    <tr>
                      <td class="text-center">{{ isset($users) ? $users->fname:'-' }}</td>
                      <td class="text-center">{{ $contact->query }}</td>
                      <td class="text-center">
                          <form class="deleteForm" action="{{ route('admin.contact_us.delete', ['id' => $contact->id]) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">
                                  {{ __('Delete') }}
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
