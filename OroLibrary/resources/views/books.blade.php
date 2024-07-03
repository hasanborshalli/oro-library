<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Book</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/books.css">
    <style>
        .toast {
            width: 250px;
            box-shadow: 0px 15px 25px 0px rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 10%;
            right: 5%;
            font-size:25px;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 15px;
            z-index:2;
        }
    
        .close-button{
            font-size:25px;
            position:absolute;
            right:5%;
            top:5%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @if(session()->has('success'))
    <div id="toast" class="toast">
        <div class="toast-header">
        <strong class="mr-auto">Oro Library</strong>
          <span aria-hidden="true" class="close-button" id="closeButton">&times;</span>
          </div>
        <p id="message">{{session('success')}}</p>
      </div>
    @endif
    <section class="left">
        <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
    </section>
    <section class="middle">
        <form action="/admin/books/search" method="GET" id="searchForm">
        <input type="search" placeholder="Search"  name="query" id="search-input">
    </form>
    @if($books->isEmpty())
        <h1 class="noMatch">We couldn't find any matches for your search.</h1>
        @else
        <ul class="books-list">
            @foreach($books as $book)
            <li>
                {{$book->title}} 
                <div  class="list-images" >
                <a href="/admin/editBook/{{$book->id}}"><img src="https://media-public.canva.com/XU2-U/MAEv6GXU2-U/1/t.png" alt=""></a>
                <a onclick="confirmAction('{{ $book->id }}')" style="cursor:pointer"><img src="https://media-public.canva.com/Khuow/MAEKu1Khuow/1/t.png" alt=""></a>
                </div>
            </li>
            @endforeach
        </ul>
        {!! $books->links() !!}
        @endif
    </section>
    <section class="right">
        <a href="/admin/addBook" id="add-book-btn">Add a Book</a>
    </section>
    <script>
        const toast=document.getElementById('toast');
        const closeButton = document.getElementById('closeButton');
        closeButton.addEventListener('click',function(){
            toast.style.display = "none"
        });
        const input = document.getElementById('search-input');
        const form = document.getElementById('searchForm');

        input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            event.preventDefault(); // Prevent default behavior (form submission)
            const inputValue = input.value.trim();
            if (inputValue.length >= 3) {
                // Set the input value to the form's 'q' parameter
                input.setAttribute('value', inputValue);
                // Submit the form programmatically
                form.submit();
            }
        }
    });
    function confirmAction(id) {
        // Display a confirmation dialog
        if (window.confirm('Are you sure you want to delete this book?')) {
            // If user clicks OK, proceed with the redirect
            window.location.href = '/admin/delete/' + id;
        } 
    }
    </script>
</body>
</html>