<?php

namespace App\Http\Controllers\BackEnd\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\Admin;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SiteAdminController extends Controller
{
  public function index()
  {
    // $information['roles'] = RolePermission::all();

    // $information['admins'] = Admin::where('role_id', '!=', NULL)->get();
    $information['admins'] = Admin::all();

    return view('backend.administrator.site-admin.index', $information);
  }

  public function get_registers_admin(Request $request)
  {
    // $language_id = $request->lang_id;
    // $default_lang = $request->default_lang;
    // $default_lang = 'en';


    $admins = Admin::where('role_id', '!=', NULL)->get();

    // dd($events);    
    $counter = 0;
    return Datatables::of($admins)
      ->addColumn('Sr', function ($admin) use (&$counter) {
        $counter++;
        return $counter;
      })
      ->addColumn('Profile Picture', function ($admin) {
        return '<img src="' . asset('assets/admin/img/admins/' . $admin->image) . '" alt="admin image" width="45">';
      })
      ->addColumn('Username', function ($admin) {
        return   $admin->username;
      })
      ->addColumn('Email ID', function ($admin) {
        return  $admin->email;
      })
      ->addColumn('Role', function ($admin) {
        $role = $admin->role()->first();
        return $role ? $role->name : '';
      })

      ->addColumn('Status', function ($admin) {
        return '<form id="statusForm-' . $admin->id . '" class="d-inline-block" action="' . route('admin.admin_management.admin.update_status', ['id' => $admin->id]) . '" method="post">
            ' . csrf_field() . '
            <select class="form-control form-control-sm ' . ($admin->status == 1 ? 'bg-success' : 'bg-danger') . '" name="status" onchange="document.getElementById(\'statusForm-' . $admin->id . '\').submit();">
              <option value="1" ' . ($admin->status == 1 ? 'selected' : '') . '>
                ' . __('Active') . '
              </option>
              <option value="0" ' . ($admin->status == 0 ? 'selected' : '') . '>
                ' . __('Deactive') . '
              </option>
            </select>
          </form>';
      })

      ->addColumn('actions', function ($admin) {
        return '   <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal" data-target="#editModal" data-id="' . $admin->id . '" data-role_id="' . $admin->role_id . '" data-first_name="' . $admin->first_name . '" data-last_name="' . $admin->last_name . '" data-image="' . asset('assets/admin/img/admins/' . $admin->image) . '" data-username="' . $admin->username . '" data-email="' . $admin->email . '">
          <i class="fas fa-edit"></i>
        </a>
  
        <form class="deleteForm d-inline-block" action="' . route('admin.admin_management.delete_admin', ['id' => $admin->id]) . '" method="post">
          ' . csrf_field() . '
          <button type="submit" class="btn btn-danger btn-sm deleteBtn">
            <i class="fas fa-trash"></i>
          </button>
        </form>';
      })


      ->rawColumns(['actions', 'Sr', 'Status', 'Profile Picture'])
      ->make(true);
  }

  // public function store(StoreRequest $request)
  public function store(Request $request)
  {
    // $imageName = UploadFile::store(public_path('assets/admin/img/admins/'), $request->file('image'));

    // 'image' => $imageName,
    // Admin::create($request->except('image', 'password') + [
    Admin::create($request->except('password') + [
      'password' => Hash::make($request->password)
    ]);

    $request->session()->flash('success', 'New admin added successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  public function updateStatus(Request $request, $id)
  {
    $admin = Admin::find($id);

    if ($request->status == 1) {
      $admin->update(['status' => 1]);
    } else {
      $admin->update(['status' => 0]);
    }

    $request->session()->flash('success', 'Status updated successfully!');

    return redirect()->back();
  }

  public function update(Request $request)
  {
    $admin = Admin::find($request->id);

    // if ($request->hasFile('image')) {
    //   $imageName = UploadFile::update(public_path('assets/admin/img/admins/'), $request->file('image'), $admin->image);
    // }

    $admin->update($request->all());

    $request->session()->flash('success', 'Admin updated successfully!');

    return response()->json(['status' => 'success'], 200);
  }

  public function destroy($id)
  {
    $admin = Admin::find($id);

    // delete admin profile picture
    @unlink(public_path('assets/admin/img/admins/') . $admin->image);

    $admin->delete();

    return redirect()->back()->with('success', 'Admin deleted successfully!');
  }
}
