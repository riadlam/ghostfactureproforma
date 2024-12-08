<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .billing-details, .order-details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>Order ID: {{ $validated['order_id'] }}</p>
    </div>

    <div class="billing-details">
        <h2>Billing Details</h2>
        <p><strong>Name:</strong> {{ $validated['billing']['name'] }}</p>
        <p><strong>Address:</strong> {{ $validated['billing']['address'] }}</p>
        <p><strong>City:</strong> {{ $validated['billing']['city'] }}</p>
        <p><strong>Postcode:</strong> {{ $validated['billing']['postcode'] }}</p>
        <p><strong>Country:</strong> {{ $validated['billing']['country'] }}</p>
        <p><strong>Email:</strong> {{ $validated['billing']['email'] }}</p>
        <p><strong>Phone:</strong> {{ $validated['billing']['phone'] }}</p>
    </div>

    <div class="order-details">
        <h2>Order Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($validated['line_items'] as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $item['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Grand Total:</strong> ${{ $validated['total'] }}</p>
    </div>
</body>
</html>
