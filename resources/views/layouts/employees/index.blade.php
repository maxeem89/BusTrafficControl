@extends('admins.layouts.master')

@section('title', 'Employees')
@section('content')
    <div class="container">
        <div class="alert-container"></div>
        <h1>Employees</h1>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('employees.create') }}" class="btn btn-success mb-2">Create New Employee</a>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Import Data</h5>
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose Excel File</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped my-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Birth Date</th>
                <th>City</th>
                <th>Country</th>
                <th>has Transportation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name.' '.$employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->city }}</td>
                    <td>{{ $employee->country }}</td>
                    <td>

                        <!-- Add a form for each row -->
                        <form class="update-transportation-form" method="POST" action="{{ route('employee.transportation.update', ['employee' => $employee->id]) }}">

                        @csrf
                            @method('PUT')
                            <!-- Add a switch input -->
                            <div class="form-check form-switch form-switch-lg d-flex justify-content-center">
                                <input class="form-check-input toggle-transportation" type="checkbox" id="flexSwitchCheckChecked" name="has_transportation" {{ $employee->has_transportation ? 'checked' : '' }}>
                            </div>

                        </form>
                    </td>
                    <td style="width: 13%">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                               class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this employee?')">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('employees.show', ['employee' => $employee->id]) }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-5 paginate">
            {!! $employees->appends(['search' => request()->input('search')])->links() !!}
        </div>
    </div>
@endsection
{{--
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('test1222');
            // Attach submit event to the form
            const updateForms = document.querySelectorAll('.update-transportation-form');
            updateForms.forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    console.log('test2'); // Removed the semicolon here
                    event.preventDefault(); // Prevent the default form submission

                    // Get the form data (serialized form data)
                    const formData = new FormData(form);

                    // Submit the form using AJAX
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Handle the response if needed (e.g., show a success message)
                            console.log(data);
                        })
                        .catch(error => {
                            // Handle errors if necessary
                            console.error(error);
                        });
                });
            });
        });
    </script>
@endpush
--}}
