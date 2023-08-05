@extends('admins.layouts.master')

@section('title', 'Employees')
@section('content')
    <div class="container" dir="">
        <h1>Create New Employee</h1>
        <form action="{{ route('employees.store') }}" method="POST" class="employee-form">
            @csrf
            <div class="form-group ">
                <label class="mx" for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ old('first_name') }}">
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ old('last_name') }}">
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required value="{{ old('address') }}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="phone">Phone Number:</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') }}">
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="date_of_birth">Birth Date:</label>
                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" required value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="city">الدولة:</label>
                <input type="text" class="form-control" id="city" name="city" required value="{{ old('city') }}">
                @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="country">المدينة:</label>
                <input type="text" class="form-control" id="country" name="country" required value="{{ old('country') }}">
                @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary my-2 text-capitalize">Submit</button>
            </div>
        </form>
    </div>
@endsection
