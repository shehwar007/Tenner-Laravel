<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Event\Booking;
use App\Models\EventOffer\Favourite;
use App\Models\Event\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
  private $admin_user_name;
  public function __construct()
  {
    $admin = Admin::select('email')->first();
    $this->admin_user_name = $admin->email;
  }

  public function index(Request $request)
  {
    $searchKey = null;

    $users = User::when($searchKey, function ($query, $searchKey) {
      return $query->where('fname', 'like', '%' . $searchKey . '%')
        ->orWhere('lname', 'like', '%' . $searchKey . '%')
        ->orWhere('email', 'like', '%' . $searchKey . '%');
    })
      ->orderBy('id', 'desc')
      ->get();
      
    return view('backend.end-user.customer.index', compact('users'));
    // return view('backend.end-user.customer.index');
  }

   
  public function get_user(Request $request)
  {

    $default_lang = $request->default_lang;
    $users = User::orderBy('id', 'desc')->get();

    return Datatables::of($users)
    ->addColumn('checkbox', function ($user) {
        return '<input type="checkbox" class="bulk-check" data-val="' . $user->id . '">';
    })
    ->addColumn('username', function ($user) {
        return $user->fname .' '.  $user->fname;
    })
    ->addColumn('email', function ($user) {
        return $user->email;
    })
    ->addColumn('phone', function ($user) {
        return empty($user->phone) ? '-' : $user->phone;
    })
    ->addColumn('account_status', function ($user) {
      return '<form id="accountStatusForm-' . $user->id . '" class="d-inline-block"
              action="' . route('admin.user_management.user.update_account_status', ['id' => $user->id]) . '"
              method="post">
              ' . csrf_field() . '
              <select class="form-control form-control-sm ' . ($user->status == 1 ? 'bg-success' : 'bg-danger') . '"
                  name="account_status"
                  onchange="document.getElementById(\'accountStatusForm-' . $user->id . '\').submit()">
                  <option value="1" ' . ($user->status == 1 ? 'selected' : '') . '>
                      ' . __('Active') . '
                  </option>
                  <option value="0" ' . ($user->status == 0 ? 'selected' : '') . '>
                      ' . __('Deactive') . '
                  </option>
              </select>
          </form>';
  })
  
  ->addColumn('email_status', function ($user) {
    return '<form id="emailStatusForm-' . $user->id . '" class="d-inline-block"
            action="' . route('admin.user_management.user.update_email_status', ['id' => $user->id]) . '"
            method="post">
            ' . csrf_field() . '
            <select class="form-control form-control-sm ' . (!is_null($user->email_verified_at) ? 'bg-success' : 'bg-danger') . '"
                name="email_status"
                onchange="document.getElementById(\'emailStatusForm-' . $user->id . '\').submit()">
                <option value="1" ' . (!is_null($user->email_verified_at) ? 'selected' : '') . '>
                    ' . __('Verified') . '
                </option>
                <option value="0" ' . (is_null($user->email_verified_at) ? 'selected' : '') . '>
                    ' . __('Not Verified') . '
                </option>
            </select>
        </form>';
})

->addColumn('actions', function ($user) use ($default_lang) {
  return '<div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ' . __('Select') . '
      </button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a href="' . route('admin.user_management.user_details', ['id' => $user->id, 'language' => $default_lang]) . '"
              class="dropdown-item">
              ' . __('Details') . '
          </a>

          <a href="' . route('admin.user_management.user_edit', ['id' => $user->id]) . '"
              class="dropdown-item">
              ' . __('Edit') . '
          </a>

          <a href="' . route('admin.user_management.user.change_password', ['id' => $user->id]) . '"
              class="dropdown-item">
              ' . __('Change Password') . '
          </a>

          <form class="deleteForm d-block"
              action="' . route('admin.user_management.user_delete', ['id' => $user->id]) . '"
              method="post">
              ' . csrf_field() . '
              <button type="submit" class="deleteBtn">
                  ' . __('Delete') . '
              </button>
          </form>

          <a target="_blank"
              href="' . route('admin.user_management.secret_login', ['id' => $user->id]) . '"
              class="dropdown-item">
              ' . __('Secret Login') . '
          </a>
      </div>
  </div>';
})

    ->rawColumns(['checkbox', 'username', 'email', 'phone', 'account_status', 'email_status', 'actions'])
    ->make(true);
    
  }


  public function create()
  {
    return view('backend.end-user.customer.create');
  }

  public function fav_list()
  {
    $favourites = Favourite::with([
      'events' => function ($query) {
          $query->select('*');
      },
      'user' => function ($query) {
          $query->select('*');
      },
  ])->select('id', 'user_id', 'event_id')
      ->orderBy('id', 'desc')
      ->get();
     
    return view('backend.end-user.customer.favourite',compact('favourites'));
  }

  public function store(Request $request)
  {
    $rules = [
      'fname' => 'required',
      'lname' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'username')
      ],
      'username' => [
        'required',
        'alpha_dash',
        "not_in:$this->admin_user_name",
        Rule::unique('users', 'username')
      ],
      'password' => 'required|confirmed|min:6'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()
      ], 400);
    }


    $in = $request->all();

    $file = $request->file('photo');
    if ($file) {
      $extension = $file->getClientOriginalExtension();
      $directory = public_path('assets/admin/img/user-profile/');
      $fileName = uniqid() . '.' . $extension;
      @mkdir($directory, 0775, true);
      $file->move($directory, $fileName);
      $in['photo'] = $fileName;
    }
    $in['status'] = 1;
    $in['email_verified_at'] = now();
    $in['password'] = Hash::make($request->password);

    User::create($in);
    Session::flash('success', 'Added Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  public function updateAccountStatus(Request $request, $id)
  {

    $user = User::find($id);
    if ($request->account_status == 1) {
      $user->update(['status' => 1]);
    } else {
      $user->update(['status' => 0]);
    }
    Session::flash('success', 'Updated Successfully');

    return redirect()->back();
  }
  public function updateEmailStatus(Request $request, $id)
  {
    $user = User::find($id);
    if ($request->email_status == 1) {
      $user->update(['email_verified_at' => now()]);
    } else {
      $user->update(['email_verified_at' => null]);
    }
    Session::flash('success', 'Updated Successfully');

    return redirect()->back();
  }
  public function changePassword($id)
  {
    $userInfo = User::findOrFail($id);

    return view('backend.end-user.customer.change-password', compact('userInfo'));
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

    $user = User::find($id);

    $user->update([
      'password' => Hash::make($request->new_password)
    ]);

    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  public function edit($id)
  {
    $user = User::findOrFail($id);
    return view('backend.end-user.customer.edit', compact('user'));
  }

  //update
  public function update(Request $request, $id, user $user)
  {
    $rules = [
      'fname' => 'required',
      'lname' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($id)
      ],
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()
      ], 400);
    }


    $in = $request->all();
    $user  = User::where('id', $id)->first();
    
    $user->update($in);
    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  public function destroy($id)
  {
    $user = User::find($id);
  
    @unlink(public_path('assets/admin/img/user-profile/') . $user->photo);
    $user->delete();

    return redirect()->back()->with('success', 'Deleted Successfully');
  }

  public function bulkDestroy(Request $request)
  {
    $ids = $request->ids;
    foreach ($ids as $id) {
      $user = User::find($id);
      @unlink(public_path('assets/admin/img/user-profile/') . $user->photo);
      $user->delete();
    }

    Session::flash('success', 'Deleted Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  //secrtet login
  public function secret_login($id)
  {
    Session::put('secret_login', true);
    $user = User::where('id', $id)->first();
    Auth::guard('web')->login($user);
    return redirect()->route('user.dashboard');
  }
}
