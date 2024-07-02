<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link rel="icon" href="/img/logo.jpeg">
    <link rel="stylesheet" href="/css/orderDetails.css">
</head>
<body>
    <div class="head">
        <a href="/Oro/admin/Library"><img src="/img/logo.jpeg" alt="" id="logo"></a>
        <h1>Order Details</h1>
        </div>
        <div class="main">
        <section class="left">
        <div class="order-number">
            {{$order->id}}
        </div>
        <div class="customer-details">
            <h1>Customer Details</h1>
            <p><strong>Name: </strong>{{$order->username}}</p>
            <p><strong>Phone: </strong>{{$order->phone}}</p>
            <p><strong>Address: </strong>{{$order->user_address}}</p>
            <p><strong>Total: </strong>{{number_format($order->total,2)}}$</p>
        </div>
    </section>
    <section class="right">
        <div class="order-items">
            <h1>Order Details</h1>
            <table class="orders">
                <thead>
                    <th style="width:10%"></th>
                    <th style="width:30%">Book Image</th>
                    <th style="width:30%">Book Name</th>
                    <th style="width:30%">Quantity</th>
                </thead>
                <tbody>
                    @foreach($items as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td><img src="/storage/images/{{$item->book->image}}" alt=""></td>
                    <td>{{$item->book->title}}</td>
                    <td>{{$item->quantity}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <div class="btns">
    <button id="edit" onclick="editOrder('{{$order->id}}')">Edit Order</button>
    <button id="decline" onclick="declineAction('{{ $order->id }}')">Decline</button>
    <button id="confirm" onclick="confirmAction('{{ $order->id }}')">Confirm</button>
    
</div>
</div>
<script>
    function confirmAction(orderId) {
        // Display a confirmation dialog
        if (window.confirm('Are you sure you want to confirm this order?')) {
            // If user clicks OK, proceed with the redirect
            window.location.href = '/order/confirm/' + orderId;
        } 
    }
    function declineAction(orderId) {
        // Display a confirmation dialog
        if (window.confirm('Are you sure you want to decline this order?')) {
            // If user clicks OK, proceed with the redirect
            window.location.href = '/order/decline/' + orderId;
        } 
    }
    function editOrder(id){
        window.location.href='/order/edit/'+id;
    }
</script>
</body>
</html>