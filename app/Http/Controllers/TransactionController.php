<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\MenuItem;
class TransactionController extends Controller
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
        $transactions = DB::table('transactions')->orderBy('date', 'desc')->paginate(5);
        $menuitems = DB::table('menu_items')->get()->toArray();
        return view('transactions.index', ['transactions' => $transactions, 'menu_items' => $menuitems]);
    }


    /**
     * Search transaction by name
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $search = $request->get('search');
        $transactions = DB::table('transactions')->where('name', 'ilike', '%'.$search.'%')->paginate(3);
        $menuitems = DB::table('menu_items')->get()->toArray();
        return view('transactions.index', ['transactions' => $transactions, 'menu_items' => $menuitems, 'searching' => true]);
    }

    /**
     * Search transaction by name and return json data
     */
    public function searchAjax(Request $request){
        $search = $request->get('search');
        $result = DB::table('transactions')->where('name', 'ilike', '%'.$search.'%')->get();
        return response()->json($result);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'payment_option'=>'required',
            'date'=>'required',
        ]);
        
        $itemJson = json_decode($request->items, true);
        $totalFood = 0;
        $totalDrink = 0;
        $totalFoodPrice = 0;
        $totalDrinkPrice = 0;
        foreach($itemJson['items'] as $item){
            $name = $item['name'];
            $quantity = $item['quantity'];
            $instance = DB::table('menu_items')->where('name', $name)->get();
            $type = $instance[0]->type;
            $price = $instance[0]->price;
            if($type == 'food'){
                $totalFood += 1;
                $totalFoodPrice += $price * $quantity;
            }else{
                $totalDrink += 1;
                $totalDrinkPrice += $price * $quantity;
            }
        }
        $transaction->name = $request->name;
        $transaction->phone = $request->phone;
        $transaction->address = $request->address;
        $transaction->date = $request->date;
        $transaction->payment_option = $request->payment_option;
        $transaction->items = $request->items;
        $transaction->total = $request->total;
        $transaction->food = $totalFood;
        $transaction->drink = $totalDrink;

        if($transaction->save()){
            return redirect()->route('admin.manageTransaction')
            ->with('success', 'Transaction added successfully');
        }
        return back()->withInput()->with('errors' , $validator->messages());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        $menuitems = DB::table('menu_items')->get()->toArray();
        $transactionitems = json_decode($transaction->items);
        return view('transactions.edit', ['transaction'=>$transaction, 'menu_items'=>$menuitems, 'items'=>$transactionitems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'payment_option'=>'required',
            'date'=>'required',
        ]);
        
        $itemJson = json_decode($request->items, true);
        $totalFood = 0;
        $totalDrink = 0;
        $totalFoodPrice = 0;
        $totalDrinkPrice = 0;
        foreach($itemJson['items'] as $item){
            $name = $item['name'];
            $quantity = $item['quantity'];
            $instance = DB::table('menu_items')->where('name', $name)->get();
            $type = $instance[0]->type;
            $price = $instance[0]->price;
            if($type == 'food'){
                $totalFood += 1;
                $totalFoodPrice += $price * $quantity;
            }else{
                $totalDrink += 1;
                $totalDrinkPrice += $price * $quantity;
            }
        }
        $transactionUpdate = Transaction::where('id', $id)-> update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'date' => $request->input('date'),
            'payment_option'=>$request->input('payment_option'),
            'items'=>$request->input('items'),
            'total' => $request->input('total'),
            'food' => $totalFood,
            'drink' => $totalDrink,
            'food_total' => $totalFoodPrice,
            'drink_total' => $totalDrinkPrice,

        ]);

        if($transactionUpdate){
            return redirect()->route('admin.manageTransaction')
            ->with('success', 'Menu item updated successfully');
        }
        return back()->withInput()->with('error' ,'Error updating Item. Please try again.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
		if($transaction->delete()){  
            //redirect
            return redirect()->route('admin.manageTransaction')
            ->with('success' , 'Transaction deleted successfully');
        }
        return back()->withInput()->with('error' , 'Transaction could not be deleted');
    }
}
