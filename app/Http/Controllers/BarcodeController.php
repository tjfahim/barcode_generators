<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class BarcodeController extends Controller
{
  

 
  
    public function index()
    {

     

      $number = mt_rand(1000000000000000, 9999999999999999); 
    
        $barcode = Barcode::orderBy('id','desc')->paginate(3);
        return view('barcode', compact('barcode','number'));

    }

    public function store(Request $request)
    { 

      

      $request->validate([
        'barcode_number' => 'required|unique:barcodes|numeric|digits:16',
    ]);
   

   


    Barcode::create($request->post());

    return redirect()->route('barcode.index')->with('success','Barcode has been created successfully.');
   
    }

   
    public function destroy(Barcode $barcode)
    {
        $barcode->delete();
        return redirect()->route('barcode.index')->with('success','Barcode has been deleted successfully');
    }
    public function generate_img($id)
    {        
      
      $number = Barcode::where('id',$id)->first();

     
      return response(DNS1D::getBarcodeSVG($number->barcode_number, 'c39',1,44)
      , 200)
      ->header('Content-Type','image/svg+xml');
      

    }
}

