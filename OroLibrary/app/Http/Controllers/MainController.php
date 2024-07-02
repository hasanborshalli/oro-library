<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\User;
use App\Models\order;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function homePage()
    {
        $books=book::orderBy('created_at', 'desc')->paginate(6);
        return view('home', ["books"=>$books]);
    }
    public function cartPage()
    {
        $cartItems=session('cart_items', []);
        $bookIds = array_column($cartItems, 'id');
        $books=book::whereIn('id', $bookIds)->get();
        return view('cart', ['books'=>$books,'cart'=>$cartItems]);
    }
    public function thankyouPage()
    {
        return view('thankyou');
    }
    
  
    public function adminPage()
    {
        return view('admin');
    }
    public function loginPage()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $fields=$request->validate([
            'name'=>['required','string'],
            'password'=>['required'],
        ]);
        if (auth()->attempt(['name'=>$fields['name'],'password'=>$fields['password']])) {
            return redirect('/Oro/admin/Library');
        } else {
            return redirect('/Oro/login/Library')->with("success", "Wrong Credentials");
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/home');
    }
    public function booksPage()
    {
        $books=book::orderBy('created_at', 'desc')->paginate(20);
        return view('books', ["books"=>$books]);
    }
    public function addBookPage()
    {

        return view('addBook');
    }
    public function editBookPage(Book $book)
    {
        
        return view('editBook', ["book"=>$book]);
    }
    public function ordersPage()
    {
        $orders=order::orderBy('created_at', 'desc')->get();
        return view('orders', ["orders"=>$orders]);
    }
    public function orderDetailsPage(order $order)
    {
        $items=$order->books()->get();
        return view('orderDetails', ["order"=>$order,"items"=>$items]);
    }
    public function stockPage()
    {
        $books=book::orderBy('created_at', 'desc')->paginate(20);
        return view('stock', ["books"=>$books]);
    }
    public function editOrderPage(order $order)
    {
        $books=book::orderBy('created_at', 'desc')->get();
        foreach($books as $book) {
            foreach($order->books as $item) {
                if($book->id==$item->book_id) {
                    $books->forget($book->id-1);
                    break;
                }
            }
        }
        return view('editOrder', ["order"=>$order,"books"=>$books]);
    }
}
