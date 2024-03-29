<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Show the employee management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

// ADMIN PRIVILEGES ==========================================================

    // Showing in the Employee Management
    public function employeeManagement()
    {
        $employees = Employee::all();
        return view('Admins.employeeManagement', compact('employees'));
    }

    // Creating Employee
    public function createEmployee(Request $request)
    {
        // Validate request
        $request->validate([
            'employee_first_name' => 'required|string|max:255',
            'employee_last_name' => 'required|string|max:255',
            'employee_birth_date' => 'required|date',
            'employee_sex' => 'required|in:Male,Female',
            'employee_phone' => 'required|string|max:20',
            'employee_house_no' => 'nullable|integer',
            'employee_street' => 'nullable|string|max:255',
            'employee_baranggay' => 'nullable|string|max:255',
            'employee_city' => 'nullable|string|max:255',
            'employee_province' => 'nullable|string|max:255',
            'employee_position' => 'required|in:Cashier,Mechanic',
            'employee_payrate_per_hour' => 'nullable|integer',
            'employee_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set default image if no image uploaded
        $imageName = 'default_photo.png';
    
        // Handle image upload if present
        if ($request->hasFile('employee_image')) {
            $employeeImage = $request->file('employee_image');
            $imageName = $employeeImage->getClientOriginalName();
            $employeeImage->move(public_path('images/employees'), $imageName);
        }
    
        $employee = Employee::create([
            'first_name' => $request->employee_first_name,
            'last_name' => $request->employee_last_name,
            'birth_date' => $request->employee_birth_date,
            'sex' => $request->employee_sex,
            'phone' => $request->employee_phone,
            'house_no' => $request->employee_house_no,
            'street' => $request->employee_street,
            'baranggay' => $request->employee_baranggay,
            'city' => $request->employee_city,
            'province' => $request->employee_province,
            'position' => $request->employee_position,
            'payrate_per_hour' => $request->employee_payrate_per_hour,
            'employee_image' => $imageName,
        ]);
    
        return redirect()->back()->with('success', 'Employee applied successfully!');
    }
}
