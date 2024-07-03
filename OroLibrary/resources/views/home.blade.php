
<x-layout>
    <form action="/home/category" method="GET" id="categoryForm">
    <select name="category" id="category" onchange="submitForm()">
        <option disabled selected>Choose category</option>
        <option>falsafe</option>
        <option>adab</option>
        <option>hayala</option>
        <option>All</option>
    </select>
    </form>
    <div class="products">
        @if($books->isEmpty())
        <h1 class="noMatch">We couldn't find any matches for your search.</h1>
        @else
            @foreach($books as $book)
            <x-book
            title="{{ $book->title }}"
            description="{{ $book->description }}"
            price="{{ $book->price }}"
            bookId="{{ $book->id }}"
            image="{{ $book->image }}"
            out="{{$book->out}}"
            liked="{{in_array($book->id,session('likes',[]))?'liked':'notliked'}}"
            />
            @endforeach
            {!! $books->links() !!}
        @endif
    </div>
  
   <script>
    function submitForm() {
        document.getElementById("categoryForm").submit();
    }
   </script>
</x-layout>