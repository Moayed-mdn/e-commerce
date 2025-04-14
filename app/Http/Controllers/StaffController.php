<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staff\CreateDeliveryBoyAccountRequest;
use App\Http\Requests\Staff\StaffLoginRequest;
use App\Http\Requests\Staff\UpdateDeliveryBoyRequest;
use App\Http\Resources\DeliveryBoyResource;
use App\Http\Resources\StaffResource;
use App\Models\DeliveryBoy;
use App\Services\DeliveryBoyService;
use App\Services\StaffService;
use Illuminate\Http\Request;



class StaffController extends Controller
{
    public function __construct(private StaffService $staffService,private DeliveryBoyService $deliveryBoyService){}

    public function checkAuth(){
        return true;

    }

    public function login(StaffLoginRequest $request){

        $staff=$this->staffService->login($request);

        return $staff ?
            $this->authSuccessResponseWithCookie(
                __('message.auth_success'),
                $staff->createToken('API TOKEN')->plainTextToken,
                new StaffResource($staff)                
            ):
            $this->errorResponse(__('message.auth_unsuccess'),'',401);
        


    }

    public function indexDeliveryBoys()
    {
        $deliveryBoys=$this->deliveryBoyService->getAllDeliveryBoys();

        return $this->dataSuccessResponse(
            __('message.done'),
            '',
            DeliveryBoyResource::collection($deliveryBoys));

    }

    public function showDeliveryBoy(Request $request,DeliveryBoy $deliveryBoy)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new DeliveryBoyResource($deliveryBoy));
    }


    public function createDeliveryBoy(CreateDeliveryBoyAccountRequest $request) {
        

        $deliveryBoy=$this->staffService->createDeliveryBoy($request);
        
        return $this->dataSuccessResponse(__('message.done'),
        '',
        new DeliveryBoyResource($deliveryBoy));

    }

    public function updateDeliveryBoy(UpdateDeliveryBoyRequest $request, DeliveryBoy $deliveryBoy)
    {    //DTO data to object 
        // Update an existing delivery boy

        $this->deliveryBoyService->updateDeliveryBoy($request,$deliveryBoy);

        
        return $this->dataSuccessResponse(__('message.done.updated'),'',new DeliveryBoyResource($deliveryBoy));


    }

    


    public function deleteDeliveryBoy(Request $request, DeliveryBoy $deliveryBoy)
    {
       
        $this->deliveryBoyService->deleteDeliveryBoy($deliveryBoy);

        return $this->successResponse(__('message.done.deleted'));
    }


}
