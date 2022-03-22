<?php

namespace App\Http\Controllers;

use DB;
use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query raw
        // $result = DB::select(DB::raw('select * from medicines'));
        // dd($result);
//query builder
        $result = DB::table('medicines')->get();
        // dd($result);
//query orm
        // $result = Medicine::all();
        // dd($result);

        return view('medicine.index',compact('result'));

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
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        $data = $medicine;
        return view('medicine.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }

    public function coba1()
    {
        //query builder filter
        // $result = DB::table('medicines')
        //                 ->where('name','like','%fen%')
        //                 ->get();

        // $result = DB::table('medicines')
        //             ->select('name, count(distinct(name)) as jumlah')
        //             ->groupBy('name')
        //             ->having('jumlah','>','1')
        //             ->get();

        // $result=DB::table('medicines')->count();

        // $result=DB::table('medicines') 
        //             ->where('price','<',20000)
        //             ->count();

        // $result=DB::table('medicines') 
        //         ->rightJoin('categories','medicines.category_id','=','categories.id')
        //         ->orderBy('price','desc')
        //         ->get();
        


        // $result=Medicine::where('price','>',20000)  
        //         ->orderBy('price','desc')
        //         ->get();
    
        // $result=Medicine::find(3);

        // $result=Medicine::max('price');

        dd($result);
    }

    public function showMaxMedicine()
    {
       
        $result=Medicine::select('medicines.name' ,'categories.category_name', 
                    DB::raw('sum(medicines.price) as total'))
                        ->join('categories', 'medicines.category_id', '=', 'categories.id')
                        ->groupBy('medicines.name', 'categories.category_name')
                        ->orderBy('total', 'desc')
                        ->take(1)
                        ->get();
        
        return view('report.list_expensive_medicine', compact('result'));
    
    }
}
