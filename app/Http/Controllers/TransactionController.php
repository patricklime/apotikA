<?php

namespace App\Http\Controllers;

use DB;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Transaction::all();
        return view('transaction.index', ['data'=>$result]);
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function showAjax(Request $request)
    {
        $myid = $request->myid;
        $cat=Transaction::find($myid);
        // $cat=Transaction::find($_POST['myid']);
        $dataObat=$cat->medicines;
        
        return response()->json(array(
            'status'=>'oke',
            
            'msg'=>view('transaction.showmodal',compact('cat','dataObat'))->render()
        ),200);

    }

    public function form_submit_front(){
        $this->authorize('checkmember');
        return view('fronted.checkout');
    }

    public function submit_front(){
        $this->authorize('checkmember');
     
        $cart = session()->get('cart');
        $user = Auth::user();
        $t = new Transaction;
        $t->pembeli_id = $user_id;
        $t->transaction_date = Carbon::now()->toDateTimeString();
        $t->save();

        $totalHarga = $t->insertProduct($cart, $user);
        $t->total = $totalHarga;
        $t->save();

        session()->forget('cart');
        return redirect("home");
    }
}
