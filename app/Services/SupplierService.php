<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService {

    public function getSuppliersForStaff(){
        
        return  Supplier::all();


    }

    public function addSupplier($request){

       return  Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
        ]);
       

    }

    public function updateSupplier($request,Supplier $supplier):bool{
      
       return $supplier->update([
            'name' => $request->name?? $supplier->name,
            'address' => $request->address ??$supplier->address,
            'description' => $request->description??$supplier->description,
        ]);


    }


    public function deleteSupplier(Supplier $supplier){
    
        return $supplier->delete();

   
    }



}