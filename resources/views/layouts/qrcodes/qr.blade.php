{{--
@extends('admins.layouts.master')

@section('title', 'Qr code')
@section('content')
<!-- Add the following HTML code to your page -->
<h1>Employee Bus Subscription Verification</h1>
<div id="qr-reader"></div>
<p id="result-message"></p>
@endsection
@push('script')
    <script>
        // Get the QR code reader element
        const qrReader = document.getElementById('qr-reader');

        // Function to display the result message
        function displayResult(message) {
            const resultMessage = document.getElementById('result-message');
            resultMessage.innerText = message;
        }

        // Initialize the QR code scanner
        const html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader",
            { fps: 10, qrbox: 250 },
            /* verbose= */ false
        );

        // Handle QR code scanning
        html5QrcodeScanner.render((qrCodeData) => {
            // Display the extracted data (employee ID) for testing purposes
            console.log('QR Code Data:', qrCodeData);

            // Send the extracted data to the server for verification
            fetch('/api/verify-subscription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ employee_id: qrCodeData }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Display a success message to the user
                        displayResult(data.message);
                    } else {
                        // Display an error message to the user
                        displayResult(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Display an error message to the user
                    displayResult('An error occurred during verification.');
                });
        });
    </script>
@endpush
--}}
