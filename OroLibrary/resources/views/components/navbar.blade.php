<nav>
    <a href="/"><h1>The Oro Library</h1></a>
    <div class="icons">
    <form action="/home/search" method="GET" id="searchForm1">
        <input type="search" id="search1" name="search" placeholder="Enter to search...🔍">
    </form> 
    <a href="/cart"><img src="/img/shopping-cart.png"></a>
    <button class="burger-menu" onclick="showMenu()">&#9776;</button>
</div>
</nav>
<section class="hidden-menu" id="hidden-menu">
    <div class="first-part">
        <a href="/"><h1>The Oro Library</h1></a>
        <form action="/home/search" method="GET" id="searchForm2">
    <input type="search" id="search2" name="search" placeholder="Enter to search...🔍">
    </form>
    </div>
    <div class="second-part">
        <a href="">New Collection</a>
        <a href="/cart">Checkout</a>
        <a href="">Social media</a>
        <a href="">Contact us</a>
    </div>
    <div class="last-part">
        <button class="burger-menu" onclick="removeMenu()">&#9776;</button>
    </div>
</section>
