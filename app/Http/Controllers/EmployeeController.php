<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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
        $documents = EmployeeDocument::all();
        return view('Admins.employeeManagement', compact('employees', 'documents'));
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
            'document_type' => 'nullable|string|max:255',
            'employee_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'files.*' => 'required|file|max:2048',
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

        foreach ($request->file('files') as $file) {
            // Generate a unique filename
            $fileName = $request->employee_first_name . '' . $request->employee_last_name . '' . $request->document_type . '_' . uniqid();
        
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
        
            // Add the file extension to the file name
            $fileNameWithExtension = $fileName . '.' . $extension;
        
            // Store the file in public/images/EmployeeDocuments folder
            $file->move(public_path('images/EmployeeDocuments'), $fileNameWithExtension);
        
            // Store the file information in the employee_documents table
            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'document_type' => $request->document_type,
                'file_name' => $fileNameWithExtension,
            ]);
        }
               
    
        return redirect()->back()->with('success', 'Employee applied successfully!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $documents = EmployeeDocument::where('employee_id', $id)->get();    
        return view('Admins.editEmployee', compact('employee', 'documents'));
    }

    public function destroyDocument($employee_id, $document_id)
{
    try {
        // Find the employee document
        $document = EmployeeDocument::where('employee_id', $employee_id)
                                     ->findOrFail($document_id);

        // Delete the document file from storage
        $filePath = public_path('Images/EmployeeDocuments/') . '/' . $document->file_name;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the document record from the database
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
    } catch (\Exception $e) {
        // Log or handle the error appropriately
        return redirect()->back()->with('error', 'Failed to delete document.');
    }
}

public function updateEmployee(Request $request, $id)
{
    // Validate request
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'birth_date' => 'required|date',
        'sex' => 'required|in:Male,Female',
        'phone' => 'required|string|max:20',
        'house_no' => 'nullable|integer',
        'street' => 'nullable|string|max:255',
        'baranggay' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'position' => 'required|in:Cashier,Mechanic',
        'payrate_per_hour' => 'nullable|integer',
        'employee_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Find the employee by ID
    $employee = Employee::findOrFail($id);

    // Handle image upload if present
    if ($request->hasFile('employee_image')) {
        $employeeImage = $request->file('employee_image');
        $imageName = $employeeImage->getClientOriginalName();
        $employeeImage->move(public_path('images/employees'), $imageName);
        $employee->employee_image = $imageName;
    }

    // Update employee information
    $employee->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'birth_date' => $request->birth_date,
        'sex' => $request->sex,
        'phone' => $request->phone,
        'house_no' => $request->house_no,
        'street' => $request->street,
        'baranggay' => $request->baranggay,
        'city' => $request->city,
        'province' => $request->province,
        'position' => $request->position,
        'payrate_per_hour' => $request->payrate_per_hour,
    ]);

    return redirect()->back()->with('success', 'Employee updated successfully!');
}

public function uploadDocuments(Request $request, $employee_id)
{
    if ($request->hasFile('files')) {
        $files = $request->file('files');
        $documentType = $request->input('document_type');

        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();

            $file->move(public_path('images/EmployeeDocuments'), $fileName);

            EmployeeDocument::create([
                'employee_id' => $employee_id,
                'document_type' => $documentType,
                'file_name' => $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Documents uploaded successfully!');
}

}