<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transactions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function search(Request $request){
        $search = $request->get('search');
        $inventories = DB::table('inventories')->where('name', 'ilike', '%'.$search.'%')->paginate(3);
        return view('inventories.index', ['inventories' => $inventories, 'searching' => true]);
    }

    // public function searchAjax(Request $request){
    //     $search = $request->get('search');
    //     $result = DB::table('inventories')->where('name', 'ilike', '%'.$search.'%')->get();
    //     return response()->json($result);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


}
