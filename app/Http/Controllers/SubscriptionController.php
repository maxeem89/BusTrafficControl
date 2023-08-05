<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function verifySubscription(Request $request)
    {
        $employeeId = $request->input('employee_id');

        // Find the employee based on the provided $employeeId
        $employee = Employee::find($employeeId);

        if ($employee && $employee->has_bus_subscription) {
            return response()->json(['status' => 'success', 'message' => 'Valid Bus Subscription']);
        }

        return response()->json(['status' => 'error', 'message' => 'No Bus Subscription Found']);
    }
    public function test(){
        return view('layouts.employees.check-employee');
    }
}
