<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    private $orderService;
    private $orderDetailService;

    public function __construct(OrderServiceInterface $orderService,OrderDetailServiceInterface $orderDetailService){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index',compact('carts','total','subtotal'));
    }

    public function addOrder(Request $request){
        //1.Them Don Hang
        $order = $this->orderService->create($request->all());

        //2.Them Chi tiet Don Hang
        $carts = Cart::content();

        foreach($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];

            $this->orderDetailService->create($data);
        }

        //3.Xoa gio hang
        Cart::destroy();

        //4.Tra ve ket qua thong bao
        return "Success!";
    }
}
