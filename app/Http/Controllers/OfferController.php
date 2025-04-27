<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\DeleteOfferRequest;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Requests\OfferDetails\StoreOfferDetailsRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Services\OfferDetailsService;
use App\Services\OfferService;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{

    public function __construct(protected OfferService $offerService,protected OfferDetailsService $offerDetailsService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $offers=$this->offerService->getOffersForStaff();

        return $this->dataSuccessResponse(__('message.done'),'',OfferResource::collection($offers));

    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {  

        $offer= $this->offerService->addOffer($request);


        return $this->dataSuccessResponse(__('message.done.added'),'',new OfferResource($offer));

    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new OfferResource($offer));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer=$this->offerService->updateOffer($request,$offer);

        return $this->dataSuccessResponse(__('message.done.updated'),'',new OfferResource($offer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteOfferRequest $request,Offer $offer)
    {

        $this->offerService->deleteOffer($offer);

        return $this->successResponse(__('message.done.deleted'));
    }
}
