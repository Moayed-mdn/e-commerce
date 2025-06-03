<?php

namespace App\Services;

use App\Http\Requests\OfferDetails\StoreOfferDetailsRequest;
use App\Models\Offer;
use App\Models\OfferDetails;
use Illuminate\Support\Facades\DB;

class OfferService {

    public function __construct(protected OfferDetailsService $offerDetailsService){}
    public function getOffersForStaff(){
        
        return Offer::paginate();

    }

    
    public function addOffer($request){

        DB::beginTransaction();
        $offer=Offer::create($request->validated());

        $this->addOfferDetails($request,$offer->id);
        
        DB::commit();

        return $offer;

    }

    public function updateOffer($request,Offer $offer):Offer{

         
        $offer->update($request->validated());

        return $offer;

    }

    public function deleteOffer(Offer $offer):bool{

        return $offer->delete();

    }   


    public function addOfferDetails($request,$offerId){
        
        $request->merge(['offer_id' => $offerId]);
        $offerDetailsRequest=new StoreOfferDetailsRequest(); 
        foreach($request->offer_details as $offerDetails){
            $offerDetailsRequest->merge(["product_item_id"=>$offerDetails['id'],"quantity"=>$offerDetails['quantity'],"offer_id"=>$offerId]);
            $offerDetailsRequest->validate($offerDetailsRequest->rules());
            $this->offerDetailsService->addOfferDetails($offerDetailsRequest); 
        }

    }




}