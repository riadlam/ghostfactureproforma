<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }
        .header h1 {
            font-size: 32px;
            font-weight: bold;
            color: #4d4d4d;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }
        .invoice-details {
            font-size: 16px;
            color: #444;
            margin: 20px 0;
        }
        .invoice-details strong {
            color: #333;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }
        table td {
            background-color: #fff;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            padding: 12px;
            background-color: #f9f9f9;
        }
        .total td {
            background-color: #fff;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #4d4d4d;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Invoice Header -->
        <div class="header">
            <h1>Invoice</h1>
            <p><strong>Customer Name:</strong> {{ $data['customer_name'] }}</p>
            <p><strong>Email:</strong> {{ $data['customer_email'] }}</p>
            <p><strong>Address:</strong> {{ $data['address'] }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($data['total_amount'], 2) }}</p>
        </div>

        <!-- Invoice Table -->
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['products'] as $product)
                    <tr>
                        <td>{{ $product['product_id'] }}</td>
                        <td><img src="{{ $product['image'] }}" alt="Product Image" class="product-image" /></td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>${{ number_format($product['price'], 2) }}</td>
                        <td>${{ number_format($product['quantity'] * $product['price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="4">Grand Total</td>
                    <td>${{ number_format($data['total_amount'], 2) }}</td>
                </tr>
            </tfoot>
        </table>
        
        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing our products! If you have any questions, please <a href="mailto:support@example.com">contact us</a>.</p>
        </div>
    </div>

</body>
</html>
