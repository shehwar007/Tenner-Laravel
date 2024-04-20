@extends('backend.layout')

@section('content')
 
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        @if(count($events) == 0)
          <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.event_popup.create_event_popup')}}">
            {{ __('Add Tenner Event Popup') }}
          </a>
       @endif
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Tenner Event Popup List</h6>
            </div>
          </div>
        
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table table-striped mt-3" id="custompages-datatables">
                <thead>
                  <tr>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Circular Pic') }}</th>
                    <th scope="col">{{ __('Flyer Pic') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($events as $event)
                    <tr>
                      <td>{{ $event->title ?? "-"}}</td>
                      <td>{{ $event->description??"-"}}</td>
                      <td><img class="index-pic" src="{{ isset($event->circle_pic) ? asset('assets/admin/img/event-popup/'.$event->circle_pic) : asset('assets/img/noimage.jpg')}}" width="100" alt="No Image"/></td>
                      <td><img class="index-pic" src="{{ isset($event->flyer_pic)?asset('assets/admin/img/event-popup/'.$event->flyer_pic) : asset('assets/img/noimage.jpg')}}" width="100" alt="No Image"/></td>
                      <td>
                                  <a class="btn btn-primary" href="{{ route('admin.event_popup.edit_event_popup', ['id' => $event->id]) }}">
                                      {{ __('Edit') }}
                                  </a>
                         
                              <!--{{-- <li>-->
                              <!--    <form class="deleteForm" action="{{ route('admin.event_popup.delete_event_popup', ['id' => $event->id]) }}" method="post">-->
                              <!--        @csrf-->
                              <!--        @method('DELETE')-->
                              <!--        <button type="submit" class="btn btn-sm btn-danger">-->
                              <!--            {{ __('Delete') }}-->
                              <!--        </button>-->
                              <!--    </form>-->
                              <!--</li> --}}-->
                      </td>
                    </tr>
                  @endforeach 
                </tbody>
              </table>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
