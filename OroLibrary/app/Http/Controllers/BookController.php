<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\like;
use App\Models\order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function like(book $book)
    {
        $bookId=$book->id;
        $likes=session('likes', []);
        if(in_array($bookId, $likes)) {
            //Remove
            $likes=array_diff($likes, [$bookId]);
            session(['likes'=>$likes]);
            $like=Like::where('book_id', $bookId)->first();
            $like->delete();
            return response()->json(['status'=>"removed"]);
        } else {
            //Add
            like::create(['book_id'=>$bookId]);
            $likes[]=$bookId;
            session(['likes'=>$likes]);
            return response()->json(['status'=>"added"]);
        }
    }
    public function searchPage(Request $request)
    {
        $fields=$request->validate([
            'query' =>['required','max:255']
        ]);
        $books=book::search($fields['query'])->paginate(6);
        return view('home', ["books"=>$books]);

    }
    public function categoryPage(Request $request)
    {
        $fields=$request->validate([
            'category' =>['required','in:falsafe,adab,hayala,All']
        ]);
        if($fields['category']=="All") {
            $books=book::orderBy('created_at', 'desc')->paginate(6);

        } else {
            $books=book::where('category', $fields['category'])->orderBy('created_at', 'desc')->paginate(6);
        }
        return view('home', ["books"=>$books]);

    }
    public function searchAdminPage(Request $request)
    {
        $fields=$request->validate([
            'query' =>['required','max:255']
        ]);
        $books=book::search($fields['query'])->paginate(20);
        return view('books', ["books"=>$books]);

    }
    public function searchOrderPage(Request $request, order $order)
    {
        $fields=$request->validate([
            'query' =>['required','max:255']
        ]);
        $books=book::search($fields['query'])->get();
        
        foreach($books as $book) {
            foreach($order->books as $item) {
                if($book->id==$item->book_id) {
                    $books->forget($book->id-1);
                    break;
                }
            }
        }
        return view('editOrder', ["order"=>$order,"books"=>$books,"success"=>"searched"]);
    }

    
    public function searchStockPage(Request $request)
    {
        $fields=$request->validate([
            'query' =>['required','max:255']
        ]);
        $books=book::search($fields['query'])->paginate(20);
        return view('stock', ["books"=>$books]);

    }
    public function addBook(Request $request)
    {
        $fields=$request->validate([
            "title"=>['required','max:255','min:3'],
            "description"=>['required','min:3'],
            "price"=>['required','numeric'],
            "category"=>['required'],
            "image"=>['required','image','mimetypes:image/jpeg,image/png,image/gif','max:2048']
        ]);
        $fields['title']=strip_tags($fields['title']);
        $fields['description']=strip_tags($fields['description']);
        $fields['price']=strip_tags($fields['price']);
        $fields['category']=strip_tags($fields['category']);
        $fields['image']=strip_tags($fields['image']);
        $file=$request->file('image');
        $customName=Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images/'.$customName);
        $fields['image']=$customName;
        book::create($fields);
        return redirect("/admin/addBook")->with('success', "Book added successfully");
    }
    public function deleteBook(book $book)
    {
        $book->delete();
        return redirect('/admin/books')->with('success', $book->title." deleted successfully");
    }
    public function editBook(Request $request, book $book)
    {
        $fields=$request->validate([
            "title"=>['required','max:255','min:3'],
            "description"=>['required','min:3'],
            "price"=>['required','numeric'],
            "category"=>['required','in:falsafe,adab,hayala'],
            "image"=>['required','image','mimetypes:image/jpeg,image/png,image/gif,image/jpg','max:2048']
        ]);
        $fields['title']=strip_tags($fields['title']);
        $fields['description']=strip_tags($fields['description']);
        $fields['price']=strip_tags($fields['price']);
        $fields['category']=strip_tags($fields['category']);
        $fields['image']=strip_tags($fields['image']);
        $file=$request->file('image');
        $customName=Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images/'.$customName);
        $fields['image']=$customName;
        $book->title=$fields['title'];
        $book->description=$fields['description'];
        $book->price=$fields['price'];
        $book->category=$fields['category'];
        $book->image=$fields['image'];
        $book->save();
        return redirect("/admin/books")->with('success', "Book edited successfully");
    }
    public function outOfStock(book $book)
    {
        if(!$book->out) {
            $book->out=1;
            $book->save();
            return response()->json(['status'=>"removed"]);

        } elseif($book->out) {
            $book->out=0;
            $book->save();
            return response()->json(['status'=>"added"]);
        }
    }
}