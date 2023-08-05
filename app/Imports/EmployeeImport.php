<?php

namespace App\Imports;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class EmployeeImport  implements ToModel, WithHeadingRow
{public function model(array $row)
    {
        info($row);
        info('--------------------------------');
        return new Employee([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'date_of_birth' => $row['date_of_birth'] ?$row['date_of_birth'] :'10/10/2022' ,
            'address' => $row['address'],
            'city' => $row['city'],
            'country' => $row['country'],
        ]);
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|numeric',
            'date_of_birth' => 'nullable|date',
            // Add more validation rules for other columns as needed
        ];
    }
    public function customValidationMessages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address already exists in the database.',
            'phone.numeric' => 'The phone field must be a number.',
            'date_of_birth.date' => 'Please enter a valid date for the date of birth field.',
            // Add more custom messages for other rules as needed
        ];
    }
}
