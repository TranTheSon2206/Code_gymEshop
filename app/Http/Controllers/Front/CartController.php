<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Service\Product\ProductServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart; 
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function add($id) {
        $product = $this->productService->find($id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,
            'options' => [
                'images'=>$product->productImages,
            ],
        ]);
        

        return back();
    }

    public function index() {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart', compact('carts', 'total', 'subtotal'));
    }

}
