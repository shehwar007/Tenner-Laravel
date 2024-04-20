@extends('backend.layout')

@section('content')
  
  <div class="row">
    <div class="col-md-12">
      <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">

        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.add.event.event')}}">
          {{ __('Add Offer Event') }}
        </a>
       
        <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
          data-href="{{ route('admin.event_management.bulk_delete_event') }}">
          <i class="flaticon-interface-5"></i> {{ __('Delete') }}
        </button>
      </div>
    </div>
  </div>

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Offers List</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="">
                  <thead>
                    <tr>
                      {{-- <th scope="col">
                        <input type="checkbox" class="bulk-check" data-val="all">
                      </th> --}}
                      <th scope="col" width="30%">{{ __('Restaurant Title') }}</th>
                      <th scope="col">{{ __('Vendor') }}</th>
                      <th scope="col">{{ __('Offer Title') }}</th>
                      <th scope="col">{{ __('Description') }}</th>
                      <th scope="col">{{ __('Enable/Disable') }}</th>
                      <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                        use App\Models\Vendor;
                        @endphp
                    @foreach ($events as $event)
                        @php
                            $vendor = Vendor::find($event->vendor_id);
                            if ($vendor != null) {
                                $vendorName = $vendor->name;
                            } else {
                                $vendorName = "Admin"; 
                            }
                        @endphp
                      <tr>
                        <td>{{ $event->rest_title }}</td>
                        <td>{{ $vendorName }}</td>
                        <td>{{ $event->offer_title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            <form id="statusForm-{{ $event->id }}" class="d-inline-block"
                              action="{{ route('admin.event_management.event.event_status', ['id' => $event->id, 'language' => request()->input('language')]) }}"
                              method="post">

                              @csrf
                              <select
                                class="form-control form-control-sm {{ $event->status == 0 ? 'bg-warning text-white' : 'bg-primary text-white' }}"
                                name="status"
                                onchange="document.getElementById('statusForm-{{ $event->id }}').submit()">
                                <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>
                                  {{ __('Enable') }}
                                </option>
                                <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>
                                  {{ __('Disable') }}
                                </option>
                              </select>
                            </form>
                          </td>
                           <td class="text-center">
                            <div>
                              <a href="{{ route('admin.event_management.edit_event', ['id' => $event->id]) }}"
                              class="btn btn-primary btn-sm">
                              {{ __('Edit') }}
                              </a>
                            <form class="deleteForm d-inline-block" action="{{ route('admin.event_management.delete_event', ['id' => $event->id]) }}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">{{ __('Delete') }}</button>
                            </form>
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
