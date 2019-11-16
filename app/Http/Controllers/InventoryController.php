<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Inventory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class InventoryController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:admin');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventoriesList = DB::table('inventories')->orderBy('name')->paginate(5);
        return view('inventories.index', ['inventories' => $inventoriesList]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Search and return all inventories with requested name
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        $search = $request->get('search');
        $inventories = DB::table('inventories')->where('name', 'ilike', '%'.$search.'%')->orderBy('name')->paginate(3);
        return view('inventories.index', ['inventories' => $inventories, 'searching' => true]);
    }

    /**
     * Search and return json data of inventories with requested name
     */

    public function searchAjax(Request $request){
        $search = $request->get('search');
        $result = DB::table('inventories')->where('name', 'ilike', '%'.$search.'%')->orderBy('name')->get();
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
        $inventory = new Inventory;
        $this->validate($request,[
                'name'=>'required',
                'supplier_id'=>'required|exists:suppliers,id',
            ]);
        $inventory->name= $request->name;
        $inventory->price= $request->price;
        $inventory->quantity = $request->quantity;
        $inventory->supplier_id = $request->supplier_id;
        $inventory->imported_date = $request->imported_date;
        if($inventory->save()){
            return redirect()->route('admin.manageInventories')
            ->with('success' , 'Inventory added successfully');
        }
        return back()->withInput()->with('errors' , $validator->messages());
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
        $inventory = Inventory::find($inventory->id);
        return view('inventories.show', ['inventory' => $inventory]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editInventory = Inventory::find($id);
        return view('inventories.edit', ['inventory'=>$editInventory]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventoryUpdate = Inventory::where('id', $id)-> update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'supplier_id' => $request->input('supplier_id'),
            'imported_date' => $request->input('imported_date'),
        ]);
        if($inventoryUpdate){
            return redirect()->route('admin.manageInventories')
            ->with('success', 'Inventory updated successfully');
        }
        return back()->withInput()->with('error' ,'Error updating Item. Please try again.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find( $id);
		if($inventory->delete()){
            
            //redirect
            return redirect()->route('admin.manageInventories')
            ->with('success' , 'Item deleted successfully');
        }
        return back()->withInput()->with('error' , 'Item could not be deleted');
    }
}
