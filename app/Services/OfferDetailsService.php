<?php

namespace App\Services;

use App\Models\OfferDetails;


class OfferDetailsService {
    
    public function getOfferDetailsForStaff(){
        
        return OfferDetails::all();

    }


    public function addOfferDetails($request){

        $offerDetails=OfferDetails::create([
            "offer_id"=>$request->offer_id,
            "product_item_id"=>$request->product_item_id,
            "quantity"=>$request->quantity
        ]);

        return $offerDetails;        

    }

    public function updateOfferDetails($request,OfferDetails $offerDetails):OfferDetails{

        $offerDetails->update($request->validated());

        return $offerDetails;

    }

    public function deleteOfferDetails(OfferDetails $offerDetails):bool{

        return $offerDetails->delete();

    }



}