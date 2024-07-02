<style>
    body{
        margin:0;
        padding:0;
    }
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
    display:none;
    z-index:2;
    animation: appear 3s;
}
@keyframes appear{
    0%{opacity:0;}
    50%{opacity:1;}
    100%{opacity:0;}
}
.close-button{
    font-size:25px;
    position:absolute;
    right:5%;
    top:5%;
    cursor: pointer;
}

</style>
<div id="toast" class="toast">
    <div class="toast-header">
    <strong class="mr-auto">Oro Library</strong>
      <span aria-hidden="true" class="close-button" id="closeButton">&times;</span>
      </div>
    <p id="message">Added to cart</p>
  </div>
{{-- link for custom css --}}
<link rel="stylesheet" href="/css/footer.css">
<link rel="stylesheet" href="/css/navbar.css">
<link rel="stylesheet" href="/css/book.css">
<link rel="stylesheet" href="/css/cart.css">
<link rel="stylesheet" href="/css/home.css">
<link rel="stylesheet" href="/css/thankyou.css">

<link rel="icon" href="/img/logo.jpeg">


{{-- link for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
{{-- links for fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Teko:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Teko:wght@300..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

<x-navbar/>
{{$slot}}
<x-footer/>
<script>
    const toast=document.getElementById('toast');
    const closeButton = document.getElementById('closeButton');
    closeButton.addEventListener('click',function(){
    toast.style.display = "none"
  });
    function fillHeart(id){
      let heart=document.getElementById('heart'+id);
      let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        }
      }
      fetch('/book/like/'+id,options)
      .then(response => response.json())
      .then((data)=>{
        if(data.status=="removed"){
          heart.classList.remove('fas');
            heart.classList.add('far');
            heart.style.color="black";
        }else{
          heart.classList.remove('far');
            heart.classList.add('fas');
            heart.style.color="red";
        }
      })
      .catch(error=>console.error("Error: ",error));
    }
    function changeBookNumber(id,operator){
        let nbBooks=document.getElementById('nbBooks'+id);
        let currentnbBooks=parseInt(nbBooks.textContent);
        if(operator==="-"){
        if(currentnbBooks>0){
        let newnbBooks=currentnbBooks-1;
        nbBooks.innerHTML=newnbBooks;
        }
      }else if(operator==="+"){
        let newnbBooks=currentnbBooks+1;
        nbBooks.innerHTML=newnbBooks;
        }
        
    }
    
    function changeBookNumberCart(id,price,operator){
        let nbBooks=document.getElementById('nbBooks'+id);
        let currentnbBooks=parseInt(nbBooks.value);
        let total=document.getElementById('order-price');
        let currentTotal=parseFloat(total.value);
        let bookPrice=document.getElementById('price'+id);
        let currentBookPrice=parseFloat(bookPrice.textContent);
        if(operator==="-"){
          if(currentnbBooks>0){
            let newnbBooks=currentnbBooks-1;
            nbBooks.value=newnbBooks;
            let newTotal=currentTotal-price;
            total.value=newTotal.toFixed(2);
            let newBookPrice=(currentBookPrice-price).toFixed(2);
            bookPrice.textContent=newBookPrice+"$";
          }
        }else if(operator==="+"){
          let newnbBooks=currentnbBooks+1;
          nbBooks.value=newnbBooks;
          let newTotal=currentTotal+price;
          total.value=newTotal.toFixed(2);
          let newBookPrice=(currentBookPrice+price).toFixed(2);
          bookPrice.textContent=newBookPrice+"$";
        }
    }
    function addCart(id){
        let nbBooks=document.getElementById('nbBooks'+id);
        let currentnbBooks=parseInt(nbBooks.textContent);
    
      let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: id,quantity: currentnbBooks})
      };
      fetch('/addCart',options)
      .then(response => response.json())
      .then((data)=>{
        if(data.status=="success"){
            toast.style.display="block";
            setTimeout(function() {
            toast.style.display = "none";
            }, 2700);
        }
      })
      .catch(error=>console.error("Error: ",error));
    }
    const hiddenMenu=document.getElementById("hidden-menu");
    const input1 = document.getElementById('search1');
    const input2 = document.getElementById('search2');
    const form1 = document.getElementById('searchForm1');
    const form2 = document.getElementById('searchForm2');
        function  showMenu(){
        hiddenMenu.classList.remove('remove');
        hiddenMenu.classList.add('animate');
        }
        function  removeMenu(){
        hiddenMenu.classList.remove('animate');
        hiddenMenu.classList.add('remove');
        }

    input1.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            event.preventDefault(); // Prevent default behavior (form submission)
            const input1Value = input1.value.trim();
            if (input1Value.length >= 3) {
                // Set the input1 value to the form's 'q' parameter
                input1.setAttribute('value', input1Value);
                // Submit the form programmatically
                form1.submit();
            }
        }
    });
    input2.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            event.preventDefault(); // Prevent default behavior (form submission)
            const input2Value = input2.value.trim();
            if (input2Value.length >= 3) {
                // Set the input2 value to the form's 'q' parameter
                input2.setAttribute('value', input2Value);
                // Submit the form programmatically
                form2.submit();
            }
        }
    });
</script>