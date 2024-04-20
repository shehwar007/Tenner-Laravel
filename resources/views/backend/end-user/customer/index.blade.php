@extends('backend.layout')

@section('content')

<div class="container-fluid py-4">
  
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">User List</h6>
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

                      <th class="text-center" scope="col">{{ __('ID') }}</th>
                      <th class="text-center" scope="col">{{ __('First Name') }}</th>
                      <th class="text-center" scope="col">{{ __('Last Name') }}</th>
                      <th class="text-center" scope="col">{{ __('Email') }}</th>
                      <th class="text-center" scope="col">{{ __('Actions') }}</th>

                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($users))
                      @foreach($users as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td class="text-center">{{ $item->fname }}</td>
                      <td class="text-center">{{ $item->lname }}</td>
                      <td class="text-center">{{ $item->email }}</td>
                      <td class="text-center">
                          <div>
                            <a href="{{ route('admin.user_management.user_edit', ['id' => $item->id]) }}"
                            class="btn btn-primary">
                            {{ __('Edit') }}
                            </a>
                    
                        <form class="deleteForm d-inline-block"
                            action={{ route('admin.user_management.user_delete', ['id' => $item->id]) }}
                            method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger deleteBtn">
                              {{ __('Delete')}}
                            </button>
                        </form>
                      </div>
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


  @section('script')
{{-- <script>
  var myTable = $('#customers_table').DataTable({
      dom: "Blfrtip",
      ordering: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      processing: true,
      serverSide: true,
      ajax: {
          url:"{{ route('admin.organizer_management.get_customer') }}",
          dataType:"json",
          type: "GET",
          data: function(d) {
              d.default_lang = "{{ $defaultLang->code }}";
          }
      }, 
      columns: [
        { data: 'checkbox', name: 'checkbox'},
        { data: 'username', name: 'username'},
        { data: 'email', name: 'email' },
        { data: 'phone', name: 'phone' },
        { data: 'account_status', name: 'account_status' },
        { data: 'email_status', name: 'email_status' },
        { data: 'actions', name: 'actions' },
      ],
      lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
    });

</script> --}}
@endsection






@endsection
