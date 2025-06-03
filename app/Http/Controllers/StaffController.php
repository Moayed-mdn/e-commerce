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
    public function login(StaffLoginRequest $request)
    {   
        $staff = $this->staffService->login($request);
    
        return $staff ?
            $this->authSuccessResponseWithCookie(
                __('auth.success'),  
                $staff->createToken('API TOKEN')->plainTextToken,
                new StaffResource($staff)                
            ) :
            $this->errorResponse(__('auth.invalid_credentials'), '', 401); 
    }
    
    public function logout(Request $request)
    {
        
        $request->user()->currentAccessToken()->delete();
        
        
        return $this->authLogoutResponseWithExpiredCookie(
            'Logout successful', 
        );
    }

    public function indexDeliveryBoys()
    {
        $deliveryBoys = $this->deliveryBoyService->index();
    
        return $this->paginateSuccessResponse(__('message.done'), DeliveryBoyResource::collection($deliveryBoys));

    }
    
    public function showDeliveryBoy(Request $request, DeliveryBoy $deliveryBoy)
    {
        return $this->dataSuccessResponse(__('response.done'), '', new DeliveryBoyResource($deliveryBoy));
    }
    
    public function createDeliveryBoy(CreateDeliveryBoyAccountRequest $request) 
    {
        $deliveryBoy = $this->deliveryBoyService->store($request);
        return $this->dataSuccessResponse(__('response.stored'), '', new DeliveryBoyResource($deliveryBoy));
    }
    
    public function updateDeliveryBoy(UpdateDeliveryBoyRequest $request, DeliveryBoy $deliveryBoy)
    {
        $this->deliveryBoyService->update($request, $deliveryBoy);
        return $this->dataSuccessResponse(__('response.updated'), '', new DeliveryBoyResource($deliveryBoy));
    }
    
    public function deleteDeliveryBoy(Request $request, DeliveryBoy $deliveryBoy)
    {
        $this->deliveryBoyService->delete($deliveryBoy);
        return $this->successResponse(__('response.deleted'));
    }

}
