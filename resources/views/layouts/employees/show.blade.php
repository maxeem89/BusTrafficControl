@extends('admins.layouts.master')

@section('title', 'Employees')
@section('content')
    <div class="container" dir="rtl">
        <!-- Your show page -->
        <h1>Show Employee Information</h1>
        <p>Employee ID: {{ $employee->id }}</p>
        <p>First Name: {{ $employee->first_name }}</p>
        <p>Last Name: {{ $employee->last_name }}</p>
        <!-- Add more details as needed -->

        <!-- Display the QR code image -->
         <div class="my-3">{{QrCode::generate(route('employees.show', ['employee' => $employee->id])) }}</div>
        <a href="{{ route('employees.downloadQR', ['employee' => $employee->id]) }}" download="qrcode.svg">
        <!-- Download link for the QR code -->
        <button type="button" class="btn btn-info mb-2">  Download QR Code</button>
      </a>

    </div>
@endsection
