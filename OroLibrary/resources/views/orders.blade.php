<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/orders.css">
</head>
<body>
    <div class="head">
        <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
        <h1>Orders</h1>
    </div>
    <table class="orders">
        <thead>
            <th style="width:2%"></th>
            <th style="width:10%">Name</th>
            <th style="width:10%">Phone</th>
            <th style="width:34%">Address</th>
            <th style="width:25%">Ordered at</th>
            <th style="width:5%">Total</th>
            <th style="width:4%"></th>
        </thead>
        <tbody>
            @php
            $counter = 0;
            @endphp
            @foreach($orders as $order)
            @if(!$order->confirmed)
            @php
            $counter++; 
            @endphp
            <tr>
            <td>{{$counter}}</td>
            <td>{{$order->username}}</td>
            <td>{{$order->phone}}</td>
            <td>{{$order->user_address}}</td>
            <td>{{$order->created_at->format('F d, Y \a\t g:i A')}}</td>
            <td>{{number_format($order->total,2)}}$</td>
            <td><a href="/order/{{$order->id}}"><img src="/img/eye.png" class="eye" alt=""></a></td>
        </tr>
        @endif
        @endforeach
        </tbody>
    </table>
</body>
</html>