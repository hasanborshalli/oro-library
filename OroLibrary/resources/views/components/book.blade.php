<div class="book-container">
    @if($liked=="liked")
    <i class='fas fa-heart heart' id="heart{{$bookId}}" style="font-size:48px;color:red;" onclick="fillHeart({{$bookId}})"></i>
    @else
    <i class='far fa-heart heart' id="heart{{$bookId}}" style="font-size:48px;color:black;" onclick="fillHeart({{$bookId}})"></i>
    @endif
    <br><br>
    <img src="/storage/images/{{$image}}" class="book-image" alt="">
    <h3 class="book-title">{{$title}}</h3>
    <p class="book-description">{{$description}}</p>
    <p class="book-price">Price: {{number_format($price,2)}}$</p>
    <div class="book-quantity">
        <button class="quantity-button" onclick="changeBookNumber({{$bookId}},'-')">-</button>
        <p class="quantity" id="nbBooks{{$bookId}}">0</p>
        <button class="quantity-button" onclick="changeBookNumber({{$bookId}},'+')">+</button>
    </div>
    <button class="book-order" onclick="addCart({{$bookId}})">Add to cart</button>
</div>
