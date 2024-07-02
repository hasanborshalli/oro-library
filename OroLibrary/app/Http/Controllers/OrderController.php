<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\order;

use App\Models\order_item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addCart(Request $request)
    {
        $fields=$request->validate([
            'id'=>['required','int'],
            'quantity'=>['required','int','min:1','max:5']
        ]);
        $bookId=$fields['id'];
        $quantity=$fields['quantity'];
        $cart=session('cart_items', []);
        $bookfound=false;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $bookId) {
                $bookfound = true;
                $cart[$key]['quantity'] += $quantity;
            }
        }
        if(!$bookfound) {
            $cart[]=['id'=>$bookId,'quantity'=>$quantity];
        }
        session(['cart_items' => $cart]);
        return response()->json(['status'=>"success"]);
    }
    public function order(Request $request)
    {
        $fields= $request->validate([
             'username' => ['required', 'string'],
             'user_address' => ['required', 'string'],
             'phone' => ['required', 'numeric','min:8'],
         ]);
        $totalPrice = 0; // Initialize total price variable
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'book_') === 0) { // Check for inputs starting with 'book_' to identify book items
                $bookId = $value;
                $quantity = $request->input('quantity_' . $bookId);
                $book = Book::find($bookId); // Assuming Book model is used
                $subtotal = $book->price * $quantity;
                $totalPrice += $subtotal;
            }
        }
        $fields['total'] = $totalPrice;// Now that we have calculated the total, add it to the validated fields
        $order = Order::create($fields);// Create a new Order instance
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'book_') === 0) {
                $bookId = $value;
                $quantity = $request->input('quantity_' . $bookId);
                // Create OrderItem for each book in the cart
                $fields2=['book_id' => $bookId, 'quantity' => $quantity,'order_id' => $order->id];
                if($quantity>0) {
                    order_item::create($fields2);
                }
            }
        }
        //remove the cart from session
        session()->forget('cart_items');
        // Redirect or respond with success message
        return redirect('/thankyou');
    

    }
    public function confirmOrder(order $order)
    {
        $order->confirmed=1;
        $order->save();
        return redirect('/admin/orders')->with('success', "Order confirmed");
    }
    public function declineOrder(order $order)
    {
        $order->delete();
        return redirect('/admin/orders')->with('success', "Order deleted");
    }
    public function editOrder(Request $request, order $order)
    {
        $fields= $request->validate([
             'username' => ['required', 'string'],
             'user_address' => ['required', 'string'],
             'phone' => ['required', 'numeric','min:8'],
         ]);
        $totalPrice = 0; // Initialize total price variable
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'book_') === 0) { // Check for inputs starting with 'book_' to identify book items
                $bookId = $value;
                $quantity = $request->input('quantity_' . $bookId);
                $book = Book::find($bookId); // Assuming Book model is used
                $subtotal = $book->price * $quantity;
                $totalPrice += $subtotal;
            }
            $fields['total'] = $totalPrice;
        }
        // Now that we have calculated the total, add it to the validated fields
        $order->username=strip_tags($fields['username']);
        $order->user_address=strip_tags($fields['user_address']);
        $order->phone=strip_tags($fields['phone']);
        $order->total=$fields['total'];
        $order->save();
        $items=$order->books()->get();
        foreach($items as $item) {
            $item->delete();
        }
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'book_') === 0) {
                $bookId = $value;
                $quantity = $request->input('quantity_' . $bookId);
                // Create OrderItem for each book in the cart
                $fields2=['book_id' => $bookId, 'quantity' => $quantity,'order_id' => $order->id];
                if($quantity>0) {
                    order_item::create($fields2);
                }
            }
        }

        // Redirect or respond with success message
        return redirect('/order/'.$order->id)->with('success', "Order Edited");
    

    }
}