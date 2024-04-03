<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function showService()
    {
        // Find the service by id
        $service = Service::all();
        
        // Pass the service data to the view
        return view('Admins.serviceManagement', compact('service'));
    }

    public function showCustomerServices()
    {
        // Retrieve all services
        $service = Service::all();
        
        // Pass services data to the view
        return view('customers.service', compact('service'));
    }

    // Creating service
    public function createService(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255|unique:services',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images
        ]);
    
        // Handle image upload
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images/Services'), $imageName);
                $imageNames[] = $imageName;
            }
        }
        // $serviceData = $validatedData;
        // $serviceData['image'] = implode('|', $imageName);
        // $service = Service::create($serviceData);
        
    
        // Store service in database
        $service = new Service();
        $service->service_name = $validatedData['service_name'];
        $service->description = $validatedData['description'];
        $service->price = $validatedData['price'];
        $service->image = implode('|', $imageNames); // Assuming 'image' is a column in your 'services' table
        $service->save();
    
        // Redirect back or wherever you want after service creation
        return redirect()->back()->with('success', 'Service created successfully!');
    }


    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('Admins.serviceUpdate', compact('service'));
    }

    public function updateService(Request $request, $id)
    {
        // Validate request
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images
        ]);

        // Find the service by id
        $service = Service::findOrFail($id);

        // Handle image upload
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('Images/Services'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Update product data
        $service->update([
            'service_name' => $validatedData['service_name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => implode('|', $imageNames),
        ]);


        // // Handle image upload
        // if ($request->hasFile('images')) {
        //     $imageNames = [];
        //     foreach ($request->file('images') as $image) {
        //         $imageName = $image->getClientOriginalName();
        //         $image->move(public_path('Images/Services'), $imageName);
        //         $imageNames[] = $imageName;
        //     }
        //     // Merge new images with existing ones
        //     $image = explode('|', $service->image);
        //     $image = array_merge($image, $imageNames);
        //     $service->image = implode('|', $image);
        // }

        // // Update service data
        // $service->update($validatedData);

        // Redirect back or wherever you want after service update
        return redirect()->route('service.show')->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        // Find the service by id
        $service = Service::findOrFail($id);

        // Delete service images
        $image = explode('|', $service->image);
        foreach ($image as $imageName) {
            $imagePath = public_path('Images/Services/') . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the service
        $service->delete();

        // Redirect back or wherever you want after service deletion
        return redirect()->back()->with('success', 'Service deleted successfully!');
    }

}