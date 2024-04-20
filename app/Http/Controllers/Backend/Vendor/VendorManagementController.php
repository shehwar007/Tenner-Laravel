<?php

namespace App\Http\Controllers\BackEnd\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class VendorManagementController extends Controller
{
  private $admin_user_name;
  public function __construct()
  {
    $admin = Admin::select('email')->first();
    $this->admin_user_name = $admin->email;
  }

  public function index(Request $request)
  {
   
    $vendors = Vendor::orderBy('id', 'desc')
    ->get();

    return view('backend.end-user.vendor.index')->with([
      'vendors'=>$vendors,
    ]);
  }

  public function get_vendor(Request $request)
  {
    // $default_lang = $request->default_lang;
    $vendors = Vendor::orderBy('id', 'desc')
      ->get();

    return Datatables::of($vendors)
      // ->addColumn('checkbox', function ($vendor) {
      //   return '<input type="checkbox" class="bulk-check" data-val="' . $vendor->id . '">';
      // })
      ->addColumn('company_name', function ($vendor) {
        return $vendor->name;
      })
      ->addColumn('email', function ($vendor) {
        return $vendor->email;
      })
      ->addColumn('phone', function ($vendor) {
        return  empty($vendor->phone) ? '-' : $vendor->phone;
      })
      // ->addColumn('account_status', function ($vendor) {
      //   return '<form id="accountStatusForm-' . $vendor->id . '" class="d-inline-block"
      //         action="' . route('admin.organizer_management.organizer.update_account_status', ['id' => $organizer->id]) . '"
      //         method="post">
      //         ' . csrf_field() . '
      //         <select class="form-control form-control-sm ' . ($vendor->status == 1 ? 'bg-success' : 'bg-danger') . '"
      //             name="account_status"
      //             onchange="document.getElementById(\'accountStatusForm-' . $vendor->id . '\').submit()">
      //             <option value="1" ' . ($vendor->status == 1 ? 'selected' : '') . '>
      //                 ' . __('Active') . '
      //             </option>
      //             <option value="0" ' . ($vendor->status == 0 ? 'selected' : '') . '>
      //                 ' . __('Deactive') . '
      //             </option>
      //         </select>
      //     </form>';
      // })

      // ->addColumn('email_status', function ($vendor) {
      //   return '<form id="emailStatusForm-' . $vendor->id . '" class="d-inline-block"
      //       action="' . route('admin.organizer_management.organizer.update_email_status', ['id' => $vendor->id]) . '"
      //       method="post">
      //       ' . csrf_field() . '
      //       <select class="form-control form-control-sm ' . (!is_null($vendor->email_verified_at) ? 'bg-success' : 'bg-danger') . '"
      //           name="email_status"
      //           onchange="document.getElementById(\'emailStatusForm-' . $vendor->id . '\').submit()">
      //           <option value="1" ' . (!is_null($vendor->email_verified_at) ? 'selected' : '') . '>
      //               ' . __('Verified') . '
      //           </option>
      //           <option value="0" ' . (is_null($vendor->email_verified_at) ? 'selected' : '') . '>
      //               ' . __('Not Verified') . '
      //           </option>
      //       </select>
      //   </form>';
      // })

      ->addColumn('actions', function ($vendor) {

        return '  <a href="' . route('admin.edit_management.vendor_edit', ['id' => $vendor->id]) . '"
        class="dropdown-item">
        ' . __('Edit') . '
    </a>

    <form class="deleteForm d-block"
        action="' . route('admin.vendor_management.vendor.delete', ['id' => $vendor->id]) . '"
        method="post">
        ' . csrf_field() . '
        <button type="submit" class="deleteBtn">
            ' . __('Delete') . '
        </button>
    </form>';
        return '<div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ' . __('Select') . '
          </button>
  
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             
            
          </div>
      </div>';
      })
      ->rawColumns(['checkbox', 'company_name', 'email', 'phone','actions'])
      ->make(true);
  }


  //add
  public function add()
  {
    return view('backend.end-user.vendor.create');
  }



public function updateAccountStatus(Request $request, $id)
{
    $vendor = Vendor::find($id);
    if (!$vendor) {
        return redirect()->back();
    }

    $vendor->account_status = $request->account_status;
    $vendor->save();

    return redirect()->back();
}


 
  public function changePassword($id)
  {
    $userInfo = Vendor::findOrFail($id);

    return view('backend.end-user.organizer.change-password', compact('userInfo'));
  }

  public function updatePassword(Request $request, $id)
  {
    $rules = [
      'new_password' => 'required|confirmed',
      'new_password_confirmation' => 'required'
    ];

    $messages = [
      'new_password.confirmed' => 'Password confirmation does not match.',
      'new_password_confirmation.required' => 'The confirm new password field is required.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()->toArray()
      ], 400);
    }

    $user = Vendor::find($id);

    $user->update([
      'password' => Hash::make($request->new_password)
    ]);

    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  public function edit($id)
  {
    $information = [];
    $vendor = Vendor::findOrFail($id);
    $information['vendor'] = $vendor;
    return view('backend.end-user.vendor.edit', $information);
  }

  //update
  public function update(Request $request, $id, Vendor $vendor)
  {
    try {
      // $rules = [
      //   'company_name' => 'required',
      // ];
      
      // 'email' => 'required|email',
      $rules = [
        'name' => 'required',
        'address' => 'required',
        'phone' => 'required',
      ];

        // 'logo' => 'required',
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return Response::json(
          [
            'errors' => $validator->getMessageBag()
          ],
          400
        );
      }

      $in = $request->all();
      $vendor  = Vendor::where('id', $id)->first();
      $file = $request->file('logo');
      if ($file) {
        $extension = $file->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/vendor-photo/');
        $fileName = uniqid() . '.' . $extension;
        @mkdir($directory, 0775, true);
        $file->move($directory, $fileName);

        @unlink(public_path('assets/admin/img/vendor-photo/') . $vendor->photo);
        $in['logo'] = $fileName;
      }
      $vendor->update($in);

    } catch (\Exception $th) {
    }
    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }
  //update_organizer_balance
 

  public function destroy($id)
  {
    $vendor = Vendor::find($id);      
    $vendor->delete();
    return redirect()->back()->with('success', 'Deleted Successfully');
  }

  public function bulkDestroy(Request $request)
  {
    $ids = $request->ids;

    foreach ($ids as $id) {
      $vendor = Vendor::find($id);
      $vendor->delete();
    }

    Session::flash('success', 'Deleted Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  //secrtet login
  public function secret_login($id)
  {
    Session::put('secret_login', 1);
    $organizer = Vendor::where('id', $id)->first();
    Auth::guard('vendor')->login($organizer);
    return redirect()->route('vendor.dashboard');
  }
  
}
