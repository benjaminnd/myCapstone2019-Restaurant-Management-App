<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminManageUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $users = User::all(); 
        return view('admin-register')->with('users', $users);
    }
}
