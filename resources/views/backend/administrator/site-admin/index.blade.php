@extends('backend.layout')

@section('content')
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-12">
              <a href="#" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left">
                <i class="fas fa-plus"></i> {{ __('Add Admin') }}
            </a>
              <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Admin List</h6>
                  </div>
                </div>
                <div class="card-body px-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        {{-- <th scope="col">{{ __('Profile Picture') }}</th> --}}
                        {{-- <th scope="col">{{ __('Username') }}</th> --}}
                        <th scope="col">{{ __('Email ID') }}</th>
                        {{-- <th scope="col">{{ __('Role') }}</th> --}}
                        {{-- <th scope="col">{{ __('Status') }}</th> --}}
                        <th scope="col">{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($admins as $admin)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                  
                          <td>{{ $admin->email }}</td>
                          
                          {{-- <td>
                            <form id="statusForm-{{ $admin->id }}" class="d-inline-block" action="{{ route('admin.admin_management.admin.update_status', ['id' => $admin->id]) }}" method="post">
                              @csrf
                              <select class="form-control form-control-sm {{ $admin->status == 1 ? 'bg-success' : 'bg-danger' }}" name="status" onchange="document.getElementById('statusForm-{{ $admin->id }}').submit();">
                                <option value="1" {{ $admin->status == 1 ? 'selected' : '' }}>
                                  {{ __('Active') }}
                                </option>
                                <option value="0" {{ $admin->status == 0 ? 'selected' : '' }}>
                                  {{ __('Deactive') }}
                                </option>
                              </select>
                            </form>
                          </td> --}}
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $admin->id }}" data-role_id="{{ $admin->role_id }}" data-first_name="{{ $admin->first_name }}" data-last_name="{{ $admin->last_name }}" data-image="{{ asset('assets/admin/img/admins/' . $admin->image) }}" data-username="{{ $admin->username }}" data-email="{{ $admin->email }}">
                              <i class="fas fa-edit"></i>
                            </a>

                            <form class="deleteForm d-inline-block" action="{{ route('admin.admin_management.delete_admin', ['id' => $admin->id]) }}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              {{-- @endif --}}
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  {{-- create modal --}}
  @include('backend.administrator.site-admin.create')

  {{-- edit modal --}}
  @include('backend.administrator.site-admin.edit')

  @section('script')
  {{-- <script>
      var myTable = $('#siteadmins-datatables').DataTable({
          dom: "Blfrtip",
          ordering: false,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
          processing: true,
          serverSide: true,
          ajax: {
              url: "{{ route('admin.admin_management.get_registered_admins_data') }}",
              
          },
          columns: [{
                  data: 'Sr',
                  name: 'Sr'
              },
              {
                  data: 'Profile Picture',
                  name: 'Profile Picture'
              },
              {
                  data: 'Username',
                  name: 'Username'
              },
              {
                  data: 'Email ID',
                  name: 'Email ID'
              },
              {
                  data: 'Role',
                  name: 'Role'
              },
              {
                  data: 'Status',
                  name: 'Status'
              },
              {
                  data: 'actions',
                  name: 'actions'
              },
          ],
          lengthMenu: [
              [10, 25, 50, -1],
              [10, 25, 50, "All"]
          ]
      });

      // initComplete: function(settings, json) {
             
      //       }
     

      // $(".dt-filter").on("change",function(){
      //     myTable.ajax.reload()
      // })
  </script> --}}
@endsection


@endsection
