<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.add_category');
    }

    public function all_category()
    {
        $all_category_info = DB::table('category')
            ->get();

        $manage_category=view('admin.all_category')
            ->with('all_category_info',$all_category_info);

        return view('admin_layout')
            ->with('admin.all_category',$manage_category);

    	//return view('admin.all_category');
    }

    public function save_category(Request $request)
    {
    	$data=array();
    	$data['category_id']=$request->category_id;
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['publication_status']=$request->publication_status;
    	
    	DB::table('category')->insert($data);
    	Session::put('message', 'Category Added Successfully!!');
    	return redirect('/add_category');

    }
    public function inactive_category($category_id)
    {
        //echo $category_id;
        DB::table('category')
        ->where('category_id', $category_id)
        ->update(['publication_status' =>0]);
        Session::put('message', 'Category Inactived Successfully!!');


        return redirect('/all_category');
    }
     public function active_category($category_id)
    {
        //echo $category_id;
        DB::table('category')
        ->where('category_id', $category_id)
        ->update(['publication_status' =>1]);
        Session::put('message', 'Category Actived Successfully!!');


        return redirect('/all_category');
    }

    public function edit_category($category_id)
    {
        //echo $category_id;
        $all_category_info=DB::table('category')
        ->where('category_id', $category_id)
        ->first();
        $manage_category=view('admin.edit_category')
            ->with('all_category_info',$all_category_info);

          return view('admin_layout')
            ->with('admin.edit_category',$manage_category);
    }

    public function update_category(Request $request, $category_id)
    {
        //echo $category_id;
        $data=array();
        $data['category_name']= $request->category_name;
        $data['category_description']= $request->category_description;
      // print_r($data);
        DB::table('category')
        ->where('category_id',$category_id)
        ->update($data);
        Session::put('message', 'Category Updated Successfully!!');

        return redirect('/all_category');

    }

    public function delete_category($category_id)
    {
        
           //echo $category_id;
         DB::table('category')
            ->where('category_id', $category_id)
            ->delete();

        Session::put('message', 'Category Delete Successfully!!');
        return redirect('/all_category');

    }
}
