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
        $sup = Supplier::all();
        $cat = Category::all();
        // dd($result);
//query orm
        // $result = Medicine::all();
        // dd($result);

        return view('medicine.index', compact('result', 'sup', 'cat'));

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

        return redirect()->route("medicines.index")->with("status", "Medicine is added!");
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
        $cat = Category::all();
        $sup = Supplier::all();

        $data = $medicine;

        return view('medicine.edit', compact('data','sup','cat'));
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
        $medicine->name = $request->name;
        $medicine->form = $request->form;
        $medicine->restriction_formula = $request->formula;
        $medicine->description = $request->description;

        $medicine->price = $request->price;
       
        $image= $request->file('image');

        if(isset($image)){
            $imageName = $image->getClientOriginalName();
            $image->move('assets/images',$imageName);

            $medicine->image = $imageName;
        }
       
        $medicine->faskes1 = isset($request->faskes1) ? 1:0;
        $medicine->faskes2 = isset($request->faskes2) ? 1:0;
        $medicine->faskes3 = isset($request->faskes3) ? 1:0;
        $medicine->category_id = $request->kategori;
        $medicine->idSupplier = $request->supplier;

        $medicine->save();

        return redirect()->route("medicines.index")->with("status", "Medicine is changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try{
            $medicine->delete();
            return redirect()->route("medicines.index")->with("status", "Data medicine is deleted!");

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";
            return redirect()->route('medicines.index')->with('error', $msg);
        }
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

    public function getEditForm(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);
        $cat = Category::all();
        $sup = Supplier::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('medicine.getEditForm', compact('data','cat','sup'))->render() 
        ), 200);
    }

    public function getEditForm2(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);
        $cat = Category::all();
        $sup = Supplier::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('medicine.getEditForm2', compact('data','sup','cat'))->render() 
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);

        $data->name = $request->myname;
        $data->form = $request->myform;
        $data->restriction_formula = $request->myformula;
        $data->description = $request->mydesk;
        $data->price = $request->myharga;

        $image= $request->myfoto;
      
        if($image != null){
           
            $data->image = $image;
        }

        $data->faskes1 = $request->myfaskes1;
        $data->faskes2 = $request->myfaskes2;
        $data->faskes3 = $request->myfaskes3;
        $data->category_id = $request->mycategory;
        $data->idSupplier = $request->mysup;

        $data->save();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>'Medicine updated',
            'kat'=>$data->category->category_name,
            'img'=>$data->image
            
        ), 200);
    }

    public function deleteData(Request $request)
    {
        try{
            $id = $request->myid;
            $medicine = Medicine::find($id);

            $medicine->delete();

            return response()->json(array(
                'status'=>'oke',
                'msg'=>'Data medicine is deleted!'
            ), 200);

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";

            return response()->json(array(
                'status'=>'oke',
                'msg'=>$msg
            ), 200);

        }
    }

}
