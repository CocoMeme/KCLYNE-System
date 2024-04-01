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
            $fileName = $request->employee_first_name . '_' . $request->employee_last_name . '_' . $request->document_type . '_' . uniqid();
        
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

    public function fetchEmployee($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json($employee);
    }

    public function fetchEmployeeDocuments($id)
    {
        // Retrieve the employee and their associated documents
        $employee = Employee::findOrFail($id);
        $documents = EmployeeDocument::where('employee_id', $id)->get();

        // Return the employee and their documents as JSON response
        return response()->json([
            'employee' => $employee,
            'documents' => $documents
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        
        $employee->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'birth_date' => $request->input('birth_date'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'house_no' => $request->input('house_no'),
            'street' => $request->input('street'),
            'baranggay' => $request->input('baranggay'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'position' => $request->input('position'),
            'payrate_per_hour' => $request->input('payrate_per_hour'),
        ]);
        //Employee_image
        if ($request->hasFile('edit_employee_image')) {
            $currentImage = $employee->employee_image;
            if ($currentImage) {
                $imagePath = public_path('images/employees') . '/' . $currentImage;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $employeeImage = $request->file('edit_employee_image');
            $imageName = $employeeImage->getClientOriginalName();
            $employeeImage->move(public_path('images/employees'), $imageName);
            $employee->update(['employee_image' => $imageName]);
        }

            return redirect()->back()->with('success', 'Employee updated successfully.');
        }

        public function destroyDocument(Request $request, $employee_id, $document_id)
        {
            // Validate the request
            $request->validate([
                'document_id' => 'required|exists:employee_documents,id',
            ]);
        
            // Find the document by its ID and employee ID
            $document = EmployeeDocument::where('id', $document_id)
                                        ->where('employee_id', $employee_id)
                                        ->firstOrFail();
        
            // Delete the document record
            $document->delete();

            // Delete the corresponding image file
            $imagePath = public_path('Images/EmployeeDocuments/' . $document->file_name);
            if (file_exists($imagePath)) {
                unlink($imagePath);
        
            // Optionally, you can return a response indicating success
            return response()->json(['message' => 'Document deleted successfully']);
        }        
    }

}
