<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/editOrder.css">

</head>
<body>
   <div align="center" class="head"> 
    <h1>Edit Order</h1>
    </div>
    <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
    <div class="container">
        <form action="/order/edit/{{$order->id}}" method="POST" enctype="multipart/form-data">
        @csrf 
        <table class="orders">
            <thead>
                <th style="width:10%"></th>
                <th style="width:30%">Book Image</th>
                <th style="width:30%">Book Name</th>
                <th style="width:30%">Quantity</th>
            </thead>
            <tbody>
                @foreach($order->books as $index=>$item)
            <tr>
                <td>{{$index+1}}</td>
                <td><img src="/storage/images/{{$item->book->image}}" alt=""></td>
                <td>{{$item->book->title}}</td>
                <td><button class="quantity-btn" type="button" onclick="nbBooks('-',{{$item->book->id}},{{$item->book->price}})">-</button><input type="text" name="quantity_{{$item->book->id}}" class="quantity" id="quantity{{$item->book->id}}" value="{{$item->quantity}}"><button class="quantity-btn" type="button" onclick="nbBooks('+',{{$item->book->id}},{{$item->book->price}})">+</button></td>
            </tr>
            <input type="hidden" name="book_{{$item->book->id}}" value="{{$item->book->id}}">
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button type="button" id="add-book" onclick="booksList()">Add Book</button></td>
            </tr>
            </tbody>
        </table><br>
        <input type="text" placeholder="Username" name="username" value="{{old('username',$order->username)}}" required><br>
        @error('username')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="text" placeholder="Address" name="user_address" value="{{old('user_address',$order->user_address)}}" required><br>
        @error('user_address')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="number" placeholder="Phone" name="phone" value="{{old('phone',$order->phone)}}" required><br>
        @error('phone')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        
        <input type="number" readonly step="0.01" name="total" id="order-price" value="{{number_format($order->total,2)}}"><br><br>
        <input type="submit" value="Edit" id="add-btn">
        </form>
    </div>
    <div class="books-list" id="books-list">
        <h1>Books</h1>
        <ul>
            @foreach($books as $book)
            <li onclick="addBook({{$book->id}},'{{$book->title}}','{{$book->image}}',{{$book->price}})">{{$book->title}}</li>
            @endforeach
        </ul>
    </div>
    <script>
        const listBooks=document.getElementById('books-list');
        const ordersTableBody = document.querySelector('.orders tbody');
        const addButton=document.getElementById('add-book');

        function addBook(bookId, bookTitle, bookImage,bookPrice) {
    // Create a new row element
    var newRow = document.createElement('tr');

    // Populate the new row with HTML content
    newRow.innerHTML = `
        <td>${ordersTableBody.rows.length}</td>
        <td><img src="/storage/images/${bookImage}" alt="Book Image"></td>
        <td>${bookTitle}</td>
        <td>
            <button class="quantity-btn" type="button" onclick="nbBooks('-', ${bookId}, ${bookPrice})">-</button>
            <input type="text" name="quantity_${bookId}" class="quantity" id="quantity${bookId}" value="1">
            <button class="quantity-btn" type="button" onclick="nbBooks('+', ${bookId}, ${bookPrice})">+</button>
        </td>
    `;

    // Append the new row to the table body
    var hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'book_'+bookId;
    hiddenInput.value = bookId;
    newRow.appendChild(hiddenInput);
    let lastRow = ordersTableBody.rows[ordersTableBody.rows.length - 1];

    // Insert the new row before the last row
    ordersTableBody.insertBefore(newRow, lastRow);
    // ordersTableBody.appendChild(newRow);
    let total=document.getElementById('order-price');
    let currentTotal=parseFloat(total.value);
    let newTotal=currentTotal+bookPrice;
    total.value=newTotal.toFixed(2);
}

        function booksList(){
            if(listBooks.style.display=="block"){
                listBooks.style.display="none";
            }else{
                listBooks.style.display="block";
            }
        }
        function nbBooks(operator,id,price){
        let nbBooks=document.getElementById('quantity'+id);
        let currentnbBooks=parseInt(nbBooks.value);
        let total=document.getElementById('order-price');
        let currentTotal=parseFloat(total.value);
        if(operator==="-"){
          if(currentnbBooks>0){
            let newnbBooks=currentnbBooks-1;
            nbBooks.value=newnbBooks;
            let newTotal=currentTotal-price;
            total.value=newTotal.toFixed(2);
          }
        }else if(operator==="+"){
          let newnbBooks=currentnbBooks+1;
          nbBooks.value=newnbBooks;
          let newTotal=currentTotal+price;
          total.value=newTotal.toFixed(2);
        }
    }

      // Get the div element

// Function to handle clicks on the document
function handleDocumentClick(event) {
    // Check if the clicked element is booksList or a descendant of booksList
    if(!addButton.contains(event.target)){
    if (!listBooks.contains(event.target)) {
        // Clicked outside the div, so hide it
        listBooks.style.display = 'none';
    }
}
}

// Add a click event listener to the document
document.addEventListener('click', handleDocumentClick);
    </script>
</body>
</html>