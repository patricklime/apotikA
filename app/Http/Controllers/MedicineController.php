<?php

namespace App\Http\Controllers;

use DB;
use App\Medicine;
use App\Category;
use App\Supplier;
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

        return view('medicine.index', compact('result'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        $sup = Supplier::all();
        
        return view("medicine.create", compact('data','sup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Medicine();
        $data->name = $request->get('name');
        $data->form = $request->get('form');
        $data->restriction_formula = $request->get('formula');
        $data->description = $request->get('description');
        $data->price = $request->get('price');
        
        $image= $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move('assets/images',$imageName);

        $data->image = $imageName;

        $data->faskes1 = isset($request->faskes1) ? 1:0;
        $data->faskes2 = isset($request->faskes2) ? 1:0;
        $data->faskes3 = isset($request->faskes3) ? 1:0;
        $data->category_id = $request->kategori;
        $data->idSupplier = $request->supplier;

        $data->save();

        return redirect()->route("medicine.index")->with("status", "Medicine is added!");
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

    public function showInfo()
    {
        $result=Medicine::orderBy('price','desc')->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>"<div class='alert alert-danger'>
                     Did you know? <br>
                     Harga obat termahal adalah ".
                     $result->generic_name . " ".$result->form . 
                     " dengan harga " . $result->price
          ),200); 
    }

}
