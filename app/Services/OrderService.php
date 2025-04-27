<?php


namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class OrderService{


public function  getOrdersForStaff(Request $request):LengthAwarePaginator{

    $query = Order::query();

    if ($request->has('status')&&in_array($request->status,OrderStatus::getStatus())) {
        $query->where('status', $request->status);
    }

    return $query->paginate();

}


public function  updateOrderByStaff($request,Order $order):bool{

    return $order->update($request->validated());

}



public function  store($request){

    return Order::create($request->validated());
    
}


public function assignDelivery($request,Order $order){ 

    $order->delivery_id=$request->delivery_id;

    return $order;
}


public function assignVehicle($request,Order $order){ 

    $order->vehicle_id=$request->vehicle_id;

    return $order;
}




}