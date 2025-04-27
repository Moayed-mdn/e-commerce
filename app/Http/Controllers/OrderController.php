<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\UpdateOrderByStaffRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function getOrdersForStaff(Request $request){
        

        $orders=$this->orderService->getOrdersForStaff($request);


        return $this->paginateSuccessResponse(
            __('message.done'),
            OrderResource::collection($orders));
    }

    public function updateOrderByStaff(UpdateOrderByStaffRequest $request,Order $order){
        
        $this->orderService->updateOrderByStaff($request,$order);

        return $this->dataSuccessResponse(__('message.done_updated'),'',new OrderResource($order));
    }



}
