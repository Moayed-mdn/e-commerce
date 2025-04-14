<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryBoyLoginReqest;
use App\Http\Resources\DeliveryBoyResource;
use App\Models\DeliveryBoy;
use App\Services\DeliveryBoyService;
use Illuminate\Http\Request;

class DeliveryBoyController extends Controller
{
    public function __construct(protected DeliveryBoyService $deliveryBoyService){}
  
    public function login(DeliveryBoyLoginReqest $request){
        
        $deliveryBoy=$this->deliveryBoyService->login($request);

        return $deliveryBoy ? 
            $this->authSuccessResponse(__('message.auth_success'),
            $deliveryBoy->createToken('API TOKEN')->plainTextToken,
            new DeliveryBoyResource($deliveryBoy)):
            $this->errorResponse(__('message.auth_unsuccess'),'',422);

    }
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryBoy $deliveryBoy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryBoy $deliveryBoy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryBoy $deliveryBoy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryBoy $deliveryBoy)
    {
        //
    }
}
