<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Users;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Hash;
//use Auth;

class UsersController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//print_r(Auth::user()->role);
		//exit;
		$users = Users::latest()->get();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = array('Admin', 'Sales Clerk', 'Report Viewer');
		return view('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required|unique:users','password'=>'required']); // Uncomment and modify if needed.
		$data = $request->all();
		$data['password'] = Hash::make($data['password']);
		Users::create($data);
		return redirect('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = Users::findOrFail($id);
		$roles = array('Admin', 'Sales Clerk', 'Report Viewer');
		return view('users.show', compact('user', 'roles'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = Users::findOrFail($id);
		$roles = array('Admin', 'Sales Clerk', 'Report Viewer');
		return view('users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$this->validate($request, ['name' => "required|unique:users,name,$id",'password'=>'required']);
		$user = Users::findOrFail($id);
		$data = $request->all();
		$data['password'] = Hash::make($data['password']);
		$user->update($data);
		return redirect('users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		die('Blocked...');
		//Users::destroy($id);
		//return redirect('users');
	}

}
