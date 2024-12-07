<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Barryvdh\DomPDF\Facade\Pdf;
class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // Log the raw request data
        Log::info('Incoming checkout request:', $request->all());
    
        // Validate the incoming data
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'total_amount' => 'required|numeric',
            'address' => 'required|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products.*.image' => 'required|url',  // Validate image URL
        ]);
    
        // Generate the PDF
        $pdf = Pdf::loadView('invoice', ['data' => $validated]);
    
        // Display the PDF in a browser-friendly view
        return $pdf->stream('invoice.pdf');
    }
    
}
