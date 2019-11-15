<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transactions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')->whereDate('date','11/13/2019')->paginate(3);
        return view('reports.index', ['transactions' => $transactions]);
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
        $food = 0;
        $drink = 0;
        $totalFood = 0;
        $totalDrink = 0;
        $cash = 0;
        $debit = 0;
        $totalCash = 0;
        $totalDebit = 0;
        $exist = null;
        $search = $request->get('search');
        $transactions = DB::table('transactions')->whereDate('date',$search)->get();
        foreach($transactions as $transaction) {
            if($transaction->payment_option == 'cash'){
                $cash += 1;
                $totalCash += $transaction->total;
            }else{
                $debit += 1;
                $totalDebit += $transaction->total;
            }
            $food += $transaction->food;
            $drink += $transaction->drink;
            $totalFood += $transaction->food_total;
            $totalDrink += $transaction->drink_total;
            $exist = true;
        }
        return view('reports.index', ['exist'=> $exist,'transactions' => $transactions, 'search' => $search, 'food' => $food, 'drink' => $drink, 'total_food' => $totalFood, 'total_drink' => $totalDrink, 'cash' => $cash, 'debit' => $debit, 'total_cash' => $totalCash, 'total_debit' => $totalDebit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


}
