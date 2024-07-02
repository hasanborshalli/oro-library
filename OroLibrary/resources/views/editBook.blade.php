<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Book</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/addBook.css">
</head>
<body>
   <div align="center" class="head"> 
    <h1>Edit Book</h1>
    </div>
    <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
    <div class="container">
        <form action="/admin/editBook/{{$book->id}}" method="POST" enctype="multipart/form-data">
        @csrf 
        <input type="text" placeholder="Title" name="title" value="{{old('title',$book->title)}}" required><br>
        @error('title')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="text" placeholder="Description" name="description" value="{{old('description',$book->description)}}" required><br>
        @error('description')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="number"  step="0.01" placeholder="Price" name="price" value="{{old('price',$book->price)}}" required id="price">
        <select name="category">
            <option  disabled selected>Choose a Category</option>
            <option >falsafe</option>
            <option >adab</option>
            <option >hayala</option>
        </select><br>
        @error('price')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="file" name="image"><br>
        @error('image')
        <p style="color:red">{{$message}}</p>
        @enderror
        <br>
        <input type="submit" value="Edit" id="add-btn">
        </form>
    </div>
</body>
</html>