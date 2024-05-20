<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h4 {
            margin: 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .invoice-total {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <h1>Order Invoice</h1>
        </div>
        <div class="invoice-details">
            <h4>Invoice Number: INV-{{ now()->format('Y') }}{{ $order->id }} </h4>

            <h4>Name: {{ $order->name }}</h4>
            <h4>Email: {{ $order->phone }}</h4>
            <h4>Shipping: {{ $order->shipping == 'pickup' ? str($order->shipping)->headline() : "Home Develiry" }}</h4>
            <h4>Address: {{ $order->shipping == 'pickup' ? str($order->point)->headline() : $order->address }}</h4>
            <h4>Date: {{ $order->created_at->format('M d, Y') }}</h4>
            <h4>Payment Method: {{ $order->payment_option == 'cod' ? 'On Delivery' :
                str($order->payment_option)->headline() }}</h4>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $key=>$item)

                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->selling_price }} tk</td>
                    <td>{{ $item->total_price }} tk</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="invoice-total">Total:</td>
                    <td>{{ $order->total_price }} tk</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>