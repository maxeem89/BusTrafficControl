<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Respon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Response;
class QrCodeController extends Controller
{
    public function generateQrCode(Employee $employee)
    {
        try {
            // Generate the QR code data in SVG format
            $qrCodeData = QrCode::generate(route('employees.show', ['employee' => $employee->id]));

            // Set the response content type to be an SVG image
            $headers = ['Content-Type' => 'image/svg+xml'];

            // Return the QR code data as a downloadable attachment
            return new Response($qrCodeData, 200, $headers, 'attachment');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Return a response indicating the error (you can customize this response)
            return response('Error: Unable to download the QR code', 500);
        }
    }
}
