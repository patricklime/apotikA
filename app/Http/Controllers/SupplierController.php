<?php

namespace App\Http\Controllers;

use DB;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();

        return view("supplier.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Supplier();
        $data->name = $request->nama;
        $data->address = $request->alamat;
        // $data->name = $request->get('nama');
        // $data->address = $request->get('alamat');
        $data->save();

        return redirect()->route("supplier.index")->with("status", "Supplier is added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $data = $supplier;
        return view('supplier.edit', compact('data'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->name = $request->nama;
        $supplier->address = $request->alamat;
        $supplier->save();

        return redirect()->route("supplier.index")->with("status", "Supplier is changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try{
            $supplier->delete();
            return redirect()->route("supplier.index")->with("status", "Data supplier is deleted!");

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";
            return redirect()->route('supplier.index')->with('error', $msg);
        }
    }
}
