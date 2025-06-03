<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(protected VehicleService $vehicleService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicles=$this->vehicleService->index($request);

        return $this->paginateSuccessResponse(__('message.done'), VehicleResource::collection($vehicles));
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle=$this->vehicleService->store($request);


        return $this->dataSuccessResponse(__('done.added'),'',new VehicleResource($vehicle));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return $this->dataSuccessResponse(__('done'),'',new VehicleResource($vehicle));
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $this->vehicleService->update($request,$vehicle);

        return $this->dataSuccessResponse(__('done.updated'),'',new VehicleResource($vehicle));

    }

    
     public function destroy(Vehicle $vehicle) 
    {
        $vehicle->delete();
        return $this->dataSuccessResponse(__('done.deleted'),'',new VehicleResource($vehicle));

    }
}
