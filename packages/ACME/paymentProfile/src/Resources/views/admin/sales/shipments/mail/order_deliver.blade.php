<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
        <h1 style="color: #333;">Order Delivery Confirmation</h1>
        @if ($order->customer_first_name != '')
            <p style="color: #666;">Dear {{ $order->customer_first_name . ' ' . $order->customer_last_name }},</p>
        @else
            <p style="color: #666;">Dear {{ $order->fbo_full_name }},</p>
        @endif
        <p style="color: #666;">Your order has been successfully delivered</p>

        <p style="color: #666;">Thank you for shopping with us!</p>
    </body>
</body>

</html>
