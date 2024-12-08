<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;

class WooCommerceController extends Controller
{
    public function handleCheckout(Request $request)
    {
        // Log the HTTP Method
        \Log::info('HTTP Method:', [$request->method()]);

        // Validate input data
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'billing.name' => 'required|string',
            'billing.address' => 'required|string',
            'billing.city' => 'required|string',
            'billing.postcode' => 'required|string',
            'billing.country' => 'required|string',
            'billing.email' => 'required|email',
            'billing.phone' => 'required|string',
            'line_items' => 'required|array',
            'line_items.*.name' => 'required|string',
            'line_items.*.quantity' => 'required|integer',
            'line_items.*.total' => 'required|string',
            'line_items.*.image_url' => 'required|url',
            'total' => 'required|string',
        ]);

        try {
            // Ensure the storage path for invoices exists
            $storagePath = storage_path('invoices');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }

            // Initialize Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true); // Enable remote images
            $dompdf = new Dompdf($options);

            // Load HTML content
            $html = view('second_invoice', compact('validated'))->render();

            // Load HTML to Dompdf
            $dompdf->loadHtml($html);

            // Set paper size
            $dompdf->setPaper('A4', 'portrait');

            // Render PDF
            $dompdf->render();

            // Save PDF
            $fileName = 'invoice_' . $validated['order_id'] . '.pdf';
            $filePath = $storagePath . '/invoice_' . $validated['order_id'] . '.pdf';
            file_put_contents($filePath, $dompdf->output());
            return response()->download($filePath, $fileName)->deleteFileAfterSend();

            // // Return response
            // return response()->json([
            //     'status' => 'Invoice generated successfully',
            //     'file_path' => $filePath,
            // ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate invoice: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function testing(Request $request)
    {
        
		\Log::info('This is a test log!');

        // Log the HTTP Method
       \Log::info('Request Data:', $request->all());
    }
}
