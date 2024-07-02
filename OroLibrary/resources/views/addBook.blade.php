<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Book</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/addBook.css">
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
   <div align="center" class="head"> 
    <h1 >Add a Book</h1>
    </div>
    <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
    <div class="container">
        <form action="/admin/addBook" method="POST" enctype="multipart/form-data">
        @csrf 
        <input type="text" placeholder="Title" name="title"  required><br><br>
        @error('title')
        <p style="color:red">{{$message}}</p>
        @enderror
        <input type="text" placeholder="Description" name="description" required><br>
        @error('description')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="number"  step="0.01" placeholder="Price" name="price" required id="price">
        @error('price')
        <p style="color:red">{{$message}}</p>
        @enderror
        <select name="category" id="">
            <option disabled selected>Choose a Category</option>
            <option>falsafe</option>
            <option>adab</option>
            <option>hayala</option>
        </select><br><br>
        <input type="file" name="image"><br>
        @error('image')
        <p style="color:red">{{$message}}</p>
        @enderror<br>
        <input type="submit" value="Add" id="add-btn">
        </form>
    </div>
    <script>
          const toast=document.getElementById('toast');
  const closeButton = document.getElementById('closeButton');
  closeButton.addEventListener('click',function(){
    toast.style.display = "none"
  });
    </script>
</body>
</html>