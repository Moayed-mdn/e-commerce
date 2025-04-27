<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleType\StoreVehicleTypeRequest;
use App\Http\Requests\VehicleType\UpdateVehicleTypeRequest;
use App\Http\Resources\VehicleTypeResrouce;
use App\Models\VehicleType;
use App\Services\VehicleTypeService;

class VehicleTypeController extends Controller
{
    public function __construct(protected VehicleTypeService $vehicleTypeService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes=$this->vehicleTypeService->index();


        return $this->dataSuccessResponse(__('message.done'),'',VehicleTypeResrouce::collection($vehicleTypes));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleTypeRequest $request)
    {
        $vehicleType=$this->vehicleTypeService->store($request);

        return $this->dataSuccessResponse(__('message.stored'),'',new VehicleTypeResrouce($vehicleType));
    }

 


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $this->vehicleTypeService->update($request,$vehicleType);

        return $this->dataSuccessResponse(__('message.updated'),'',new VehicleTypeResrouce($vehicleType));

    }


}
