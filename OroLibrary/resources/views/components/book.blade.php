@if($out==1)
<style>
    #book-image-{{$bookId}}{
        opacity:0.2;
    }
    .red-line {
  position: absolute;
  top: 0;
  left: 0;
  width: 130%;
  height: 5px; /* Adjust height as needed */
  background-color: red;
  transform: rotate(45deg); /* Rotate the line to make it diagonal */
  transform-origin: left top;
  text-align: center;
  font-size:30px;
}
.image-wrapper {
  position: relative;
  margin: 10px;
}
</style>
@endif
<div class="book-container">
    @if($liked=="liked")
    <i class='fas fa-heart heart' id="heart{{$bookId}}" style="font-size:48px;color:red;" onclick="fillHeart({{$bookId}})"></i>
    @else
    <i class='far fa-heart heart' id="heart{{$bookId}}" style="font-size:48px;color:black;" onclick="fillHeart({{$bookId}})"></i>
    @endif
    <br><br>
    <div class="image-wrapper">
    <img src="/laravel/storage/app/public/images/{{$image}}" id="book-image-{{$bookId}}" class="book-image" alt="">
    @if($out==1)
    <div class="red-line">Out of Stock</div>
    @endif
    </div>
    <h3 class="book-title">{{$title}}</h3>
    <p class="book-description">{{$description}}</p>
    <p class="book-price">Price: {{number_format($price,2)}}$</p>
    <div class="book-quantity">
        <button class="quantity-button" onclick="changeBookNumber({{$bookId}},'-')">-</button>
        <p class="quantity" id="nbBooks{{$bookId}}">0</p>
        <button class="quantity-button" onclick="changeBookNumber({{$bookId}},'+')">+</button>
    </div>
    @if($out==0)
    <button class="book-order" onclick="addCart({{$bookId}})">Add to cart</button>
    @else
    <button class="book-order">Add to cart</button>
    @endif
</div>
