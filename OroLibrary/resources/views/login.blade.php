<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/login.css">
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
    <img src="/img/logo.jpeg" alt="" id="logo">
    <div class="container">
        <form action="/admin/login" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Username" id="name-input" required><br><br>
        <input type="text" name="password" placeholder="Password" id="pass-input" required><br><br>
        <input type="submit" value="Login" id="login-btn">
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