<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/stock.css">
</head>
<body>
    <h1 align="center" style="font-size:50px;">Stock</h1>
    <div class="main">
    <section class="left">
      <form action="/admin/stock/search" method="GET" id="searchForm">
        <input type="search" placeholder="Search"  name="query" id="search-input">
    </form><br><br><br>
        <ul class="books-list">
          @foreach($books as $book)
            <li>{{$book->title}} <div id="{{$book->id}}" class="toggle-button {{$book->out ? 'toggle-on':""}}" >
                <div class="switch"></div>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
    <section class="right">
        <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt=""></a>
    </section>
</div>
<script>
    const toggleButtons = document.querySelectorAll('.toggle-button');
  toggleButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      toggleButton(button);
    });
  });


function toggleButton(button) {
  const switchElement = button.querySelector('.switch');
  const isOn = button.classList.contains('toggle-on');
  let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        },
        
      };
      fetch('/book/out/'+button.id,options)
      .then(response => response.json())
      .then((data)=>{
        if(data.status=="removed"){
          button.classList.add('toggle-on');
          
        }else{
          button.classList.remove('toggle-on');
        }
      })
      .catch(error=>console.error("Error: ",error));
    
  // if (isOn) {
  //   button.classList.remove('toggle-on');
  // } else {
  //   button.classList.add('toggle-on');
  // }
}

</script>
</body>
</html>