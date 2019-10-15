<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usersList = User::all();
        return view('users.index', ['usersList' => $usersList]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
            
        ]);
        if($user){
            return redirect()->route('users.show', ['singleUserData' => $user->id])
            ->with('success', 'User data created successfully');
        }
    
    
    return back()->withInput()->with('errors', 'Error creating new User');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $singleUser = User::find($user->id);
        return view('users.show', ['singleUserData' => $singleUser]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $singleUserData = User::find($user->id);
        return view('users.edit', ['singleUserData' => $singleUserData]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // save data 
        $userUpdate = User::where('id', $user->id)-> update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'fine' => $request->input('fine'),
        ]);
        if($userUpdate){
            return redirect()->route('users.show', ['user' => $user->id])
            ->with('success', 'User data updated successfully');
        }
        return back()->withInput()->with('error' , 'User data cannot be updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // delete user account
        $findUser = User::find( $user->id);
		if($findUser->delete()){
            
            //redirect
            return redirect()->route('users.index')
            ->with('success' , 'User deleted successfully');
        }
        return back()->withInput()->with('error' , 'User could not be deleted');
    }
}
