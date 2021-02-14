<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use DB;
use Session;

session_start();
class AdminController extends Controller
{
    public function index()
    {
    	return view('admin_login');
    }

    public function show_dashboard()
    {
    	return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    { 
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);
    	$result =db::table('admin')
    				->where('admin_email',$admin_email)
    				->where('admin_password',$admin_password)
    				->first();
    				
    	if ($result)
    	 {
    	 	Session::put('admin_name', $request->admin_name);
    	 	Session::put('admin_id', $request->admin_id);
    	
    	 	return redirect('/dashboard');
    								
    	}else
    	{
    		Session::put('message', 'Email or Password Invalid');
    		return redirect('/index');

    	}						
    }
}
