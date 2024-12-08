<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        .invoice-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            font-size: 28px;
            margin: 0;
            color: #007bff;
        }

        .invoice-header p {
            margin: 5px 0 0;
            font-size: 16px;
            color: #555;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #444;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .billing-details, .order-details {
            margin-bottom: 30px;
        }

        .billing-details p, .order-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table td {
            background-color: #f9f9f9;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .grand-total {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <h1>Facture</h1>
            <p>ID de Commande: {{ $validated['order_id'] }}</p>
        </div>

        <!-- Billing Details -->
        <div class="billing-details">
            <h2 class="section-title">Détails de Facturation</h2>
            <p><strong>Nom:</strong> {{ $validated['billing']['name'] }}</p>
            <p><strong>Adresse:</strong> {{ $validated['billing']['address'] }}</p>
            <p><strong>Ville:</strong> {{ $validated['billing']['city'] }}</p>
            <p><strong>Code Postal:</strong> {{ $validated['billing']['postcode'] }}</p>
            <p><strong>Pays:</strong> {{ $validated['billing']['country'] }}</p>
            <p><strong>Email:</strong> {{ $validated['billing']['email'] }}</p>
            <p><strong>Téléphone:</strong> {{ $validated['billing']['phone'] }}</p>
        </div>

        <!-- Order Details -->
        <div class="order-details">
            <h2 class="section-title">Détails de la Commande</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image du Produit</th>
                        <th>Nom du Produit</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($validated['line_items'] as $item)
                        <tr>
                            <td>
                                <img 
                                    class="product-image" 
                                    src="{{ $item['image_url'] }}" 
                                    alt="{{ $item['name'] }}"
                                >
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['total'] }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="grand-total">Total Général: {{ $validated['total'] }} €</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            Merci pour votre achat ! Si vous avez des questions, n'hésitez pas à nous contacter.
        </div>
    </div>
</body>
</html>
