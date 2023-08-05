<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::query();
        if($request->search)
        {
            $employees = $employees->where('first_name','LIKE','%'.$request->search.'%')->orWhere('last_name','LIKE','%'. $request->search.'%');
        }
        $employees = $employees->paginate(10);
        return view('layouts.employees.index')->with(compact('employees'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {

        try {
            // Begin the transaction
            DB::beginTransaction();

            $employee = Employee::create(array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => Carbon::createFromFormat('d/m/Y',$request->date_of_birth)->format('Y-m-d'),
            'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
            ));

            $employeeId = $employee->id;

            // Generate the QR code as SVG string
            $qrCodeSvg = QrCode::size(100)->generate("Employee ID: $employeeId");
            $qrCodePath = "qrcodes/employee_$employeeId.svg";

            // Save the SVG to the storage
            Storage::put($qrCodePath, $qrCodeSvg);

            // Save the QR code path to the employee record in the database
            $employee->qr_code_path = $qrCodePath;
            $employee->save();



            DB::commit();
            return redirect()->Route('employees.index');

        } catch (\Exception $e) {
            DB::rollback();
            // Store the error message in the session
            Session::flash('error', 'An error occurred while creating the employee.');
           info($e);
            // Redirect back to the form with the error message
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $qrCodeData = QrCode::generate(route('employees.show', ['employee' => $employee->id]));


        return view('layouts.employees.show')->with(compact('employee', 'qrCodeData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('layouts.employees.edit')->with(compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request,Employee $employee)
    {
               try {
                   // Begin the transaction
                   DB::beginTransaction();
                   $employee->update([
                       'first_name' => $request->first_name,
                       'last_name' => $request->last_name,
                       'email' => $request->email,
                       'phone' => $request->phone,
                       'date_of_birth' => Carbon::createFromFormat('d/m/Y',$request->date_of_birth)->format('Y-m-d'),
                       'address' => $request->address,
                       'city' => $request->city,
                       'country' => $request->country,
                   ]);
                   DB::commit();
                   return redirect()->Route('employees.index');

               } catch (\Exception $e) {
                   DB::rollback();
                   info($e);
                   // echo "Error: " . $e->getMessage();
               }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            //dd($file);
            $import = new EmployeeImport();
            $data = Excel::import($import, $file);
            // Process $data as needed
        }
        return redirect()->back()->with('success', 'Data imported successfully!');

    }

    public function updateTransportationStatus(Request $request, Employee $employee)
    {
        $employee->update(['has_transportation' => $request->has_transportation =='on' ? true : false]);
        return response()->json(['message' => 'Employee transportation status updated successfully']);
    }
}
