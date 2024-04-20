<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\CustomPage\Page;
use App\Models\CustomPage\PageContent;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;
use Yajra\DataTables\Facades\DataTables;

class CustomPageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // then, get the custom pages of that language from db
    $information['pages'] = DB::table('page_contents')
      ->get();
    return view('backend.custom-page.index', $information);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('backend.custom-page.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $messages = [];
      // $rules['content'] = 'min:15';

      $rules['content'] = 'required';
      // $messages['content.min'] = 'The content field atleast have 15 characters';
  
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()->toArray()
      ], 400);
    }

      $pageContent = new PageContent();
      $pageContent->content = $request->content;      
      $pageContent->save();
      Session::flash('success', 'Added Successfully');
       
      $status = [
          'status' => 'success',
          'redirect_url' => route('admin.custom_pages'),
      ];
      // dd($status);
      
      return Response::json($status, 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    // $information['page'] = PageContent::where('id', $id)->firstOrFail();
    $information['page'] = PageContent::orderBy('content')->first();
   
    return view('backend.custom-page.edit', $information);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
//   public function update(Request $request, $id)
  public function update(Request $request)
  {  
    // dd($request->all());
    $messages = [];
    $rules['content'] = 'required';
    // $messages['content.min'] = 'The content field atleast have 15 characters';
    

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()->toArray()
      ], 400);
    }
    
    if($request->page_id == ""){
          $pageContent = new PageContent();
      $pageContent->content = $request->content;      
      $pageContent->save();
      Session::flash('success', 'Added Successfully');
       
      $status = [
          'status' => 'success',
          'redirect_url' => route('admin.custom_pages'),
      ];
      // dd($status);
      
      return Response::json($status, 200);  
    }
    else
    {
       $pageContent = PageContent::where('id', $request->page_id)
        ->first(); 
    $pageContent->content = $request->content; 
    $pageContent->save();
  
    Session::flash('success', 'Updated Successfully');

      $status = [
          'status' => 'success',
          'redirect_url' => route('admin.custom_pages'),
      ];
    return Response::json($status, 200);   
    }
    // return Response::json(['status' => 'success'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    PageContent::where('id', $id)->first()->delete();
    return redirect()->back()->with('success', 'Deleted Successfully');
  }

}
