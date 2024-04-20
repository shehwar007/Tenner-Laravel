<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\CustomPage\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
  public function index(Request $request)
  {
    // then, get the custom pages of that language from db
    $information['contacts'] = DB::table('contacts')
      ->get();
    return view('backend.contact-us.index', $information);
  }

  public function destroy($id)
  {
    Contact::where('id', $id)->first()->delete();
    return redirect()->back()->with('success', 'Deleted Successfully');
  }

}
