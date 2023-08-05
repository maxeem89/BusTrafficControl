@extends('admins.layouts.master')

@section('title', 'Employees')
@section('content')
    <div class="container">
        <h1>Edit Employee</h1>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="employee-form">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" id="id" name="id" required value="{{$employee->id  }}">

            <div class="form-group">
                <label class="mx" for="first_name">الإسم الأول</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ old('first_name') ?old('first_name')  :$employee->first_name  }}">
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="last_name">الإسم الثاني</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ old('last_name') ? old('last_name') :$employee->last_name }}">
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="email">الإيميل</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') ? old('email') : $employee->email}}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="address">العنوان</label>
                <input type="text" class="form-control" id="address" name="address" required value="{{ old('address') ? old('address') :$employee->address }}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="phone">رقم الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') ? old('phone') :$employee->phone }}">
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="date_of_birth">تاريخ الميلاد</label>
                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" required value="{{ old('date_of_birth') ? old('date_of_birth') : $employee->date_of_birth }}">
                @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="city">الدولة</label>
                <input type="text" class="form-control" id="city" name="city" required value="{{ old('city') ? old('city') : $employee->city }}">
                @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mx" for="country">المدينة</label>
                <input type="text" class="form-control" id="country" name="country" required value="{{ old('country') ? old('country') : $employee->country }}">
                @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
