<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usersList = DB::table('users')->orderBy('name')->paginate(5);
        return view('users', ['users' => $usersList]);
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

    public function search(Request $request){
        $search = $request->get('search');
        $users = DB::table('users')->where('name', 'ilike', '%'.$search.'%')->orderBy('name')->paginate(3);
        return view('users', ['users' => $users, 'searching' => true]);
    }

    public function searchAjax(Request $request){
        $search = $request->get('search');
        $result = DB::table('users')->where('name', 'ilike', '%'.$search.'%')->orderBy('name')->get();
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $this->validate($request,[
                'name'=>'required',
                'email'=>'required|unique:users|unique:admins',
                'password'=>'required|string|min:5',
            ]);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return redirect()->route('admin.manageUsers')
            ->with('success' , 'User added successfully');
        }
        return back()->withInput()->with('errors' , $validator->messages());
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
    public function edit($id)
    {
        $editUser = User::find($id);
        return view('users.edit', ['user'=>$editUser]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate request input, ignore current id
        // Validator::make($data, [
        //     'name' => ['required'],
        //     'email' => ['required',
        //                 Rule::unique('users')->ignore($id),
        //                 Rule::unique('admins')],
        //     'password'=> ['required',
        //                   'string',
        //                   'min:5'
        //                 ]
        // ]);
        // $this->validate($request,[
        //     'name'=>'required',
        //     'email'=>'required|unique:users|unique:admins',
        //     'password'=>'required|string|min:5',
        // ]);
        // save data 
        $userUpdate = User::where('id', $id)-> update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        if($userUpdate){
            return redirect()->route('admin.manageUsers')
            ->with('success', 'User data updated successfully');
        }
        return back()->withInput()->with('error' ,'Error updating user. Please try again.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find( $id);
		if($user->delete()){
            
            //redirect
            return redirect()->route('admin.manageUsers')
            ->with('success' , 'User deleted successfully');
        }
        return back()->withInput()->with('error' , 'User could not be deleted');
    }
}
