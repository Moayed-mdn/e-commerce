<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemToCart;
use App\Models\ProductItem;
use App\Models\ShoppingCart;
use Illuminate\Http\Request; 

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShoppingCart::where('status','pending')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemToCart $request)
    {   
        $userId=request()->user()->id;

        $productItemId = $request->product_item_id;
        $requestedQuantity = $request->quantity;
        $productItem=ProductItem::find($productItemId);
        if ($productItem->quantity < $requestedQuantity) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock.',
                'available_stock' => $productItem->quantity,
                'requested_quantity' => $requestedQuantity
            ], 400); 
        }

        
        $cartItem = ShoppingCart::where('user_id', $userId)
                                ->where('product_item_id', $productItemId)
                                ->where('status', 'pending') 
                                ->first();

        if ($cartItem) {
            
            $cartItem->quantity = $requestedQuantity; 
            $cartItem->save();
            return response()->json(['message' => 'Cart item quantity updated successfully.', 'cart_item' => $cartItem], 200);
        } else {
            
            $newCartItem = ShoppingCart::create([
                'user_id' => $userId,
                'product_item_id' => $productItemId,
                'quantity' => $requestedQuantity, 
                'status' => 'pending',
            ]);

            return response()->json(['message' => 'Item added to cart successfully.', 'cart_item' => $newCartItem], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingCart $ShoppingCart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingCart $ShoppingCart)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingCart $ShoppingCart)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCart $ShoppingCart)
    {
        
    }
}
