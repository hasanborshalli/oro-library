

<x-layout>
    <section class="cart">
        <div class="order-details">
            <p><strong>Your order is</strong></p>
            <form action="/order" method="POST" >
                @csrf
                <ul class="order-list">
                @php
                $totalPrice = 0; // Initialize total price variable
                @endphp
                @foreach($books as $index=>$book)
                    <li style="display:flex;align-items:center;margin-bottom:15px;">
                        {{$book->title}}
                        <div class="book-quantity-cart">
                            <input type="button" class="quantity-button-cart" onclick="changeBookNumberCart({{$book->id}},{{$book->price}},'-')" value="-">
                            <input readonly type="text" class="quantity-cart" name="quantity_{{$book->id}}" class="quantity" id="nbBooks{{$book->id}}" value="{{$cart[$index]['quantity']}}">
                            @error('quantity_{{$book->id}}')
                            <p style="color:red">{{$message}}</p>
                            @enderror
                            <input type="hidden" name="book_{{$book->id}}" value="{{$book->id}}">
                            <input type="button" class="quantity-button-cart" onclick="changeBookNumberCart({{$book->id}},{{$book->price}},'+')" value="+">
                            <p id="price{{$book->id}}">{{number_format($book->price*$cart[$index]['quantity'],2)}}<span>$</span></p>
                        </div>
                    </li>
                    <hr style="margin:10px;border-width:2px;width:80%;">
                    @php
                    $subtotal = $cart[$index]['quantity'] * $book->price;// Calculate subtotal for this book
                    $totalPrice += $subtotal;// Add subtotal to total price
                    @endphp
                @endforeach
            </ul>
            <p class="order-price">Total: <input readonly type="text"  name="total" id="order-price" value="{{number_format($totalPrice, 2)}}">$
                @error('total')
                <p style="color:red">{{$message}}</p>
                @enderror
        </div>
        <hr>
            <div class="order-form">
                <input type="text" placeholder="Full Name" name="username"><br>
                @error('username')
                <p style="color:red">{{$message}}</p>
                @enderror
                <br>
                <textarea name="user_address" id="address" cols="30" rows="4" placeholder="Full Address"></textarea><br>
                @error('user_address')
                <p style="color:red">{{$message}}</p>
                @enderror
                <br>
                <input type="text" placeholder="Phone Number" name="phone"><br>
                @error('phone')
                <p style="color:red">{{$message}}</p>
                @enderror
                <br>
                <input type="submit" value="Order Now">
            </div>
        </form>
    </section>
</x-layout>