<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->addToWish($product);

        Cart::instance('wishlist')->add(
            $product->id,
            $product->title,
            1,
            $product->end_Price
        )->associate($product);

        return redirect()->back()->with('success', 'Product added to Wishlist');
    }

    public function delete(Product $product)
    {
        $status = 'danger';
        $message = 'Smth wrong!)';
        if ($cartItem = Cart::instance('wishlist')->content()->where('id', $product->id)?->first()){
            auth()->user()->removeFromWish($product);
            Cart::instance('wishlist')->remove($cartItem->rowId);

            $status = 'success';
            $message = 'All right everybody';
        }

        return redirect()->back()->with($status, $message);
    }
}
