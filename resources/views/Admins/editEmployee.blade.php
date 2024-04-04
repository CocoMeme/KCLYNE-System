@extends('Layouts/header')
<body>

@if(session('success'))
        <div class="success-message-admin">
            {{ session('success') }}
        </div>
    @endif

@auth('admin') 
<section class="employee-management">
<div class="show-employee">
    <h2 style="text-align: center;">Edit Employee Information</h2>
    <form method="POST" class="form-create-product" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="employee-image-container">
            <img src="{{ asset('Images/Employees/' . $employee->employee_image) }}" alt="Employee Image" class="edit-employee-image">
        </div>

    <div class="group">
        <input type="file" id="edit_employee_image" name="edit_employee_image" class="form-control">
    </div>

    <div class="group">
        <label for="edit_first_name">First Name:</label>
        <input type="text" id="edit_first_name" name="first_name" value="{{ $employee->first_name }}">
        <br>
    </div>

    <div class="group">
        <label for="edit_last_name">Last Name:</label>
        <input type="text" id="edit_last_name" name="last_name" value="{{ $employee->last_name }}">
        <br>
    </div>

    <div class="group">
    <label for="edit_birth_date">Birth Date:</label>
    <input type="date" id="edit_birth_date" name="birth_date" value="{{ $employee->birth_date }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_sex">Sex:</label>
    <input type="text" id="edit_sex" name="sex" value="{{ $employee->sex }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_phone">Phone:</label>
    <input type="text" id="edit_phone" name="phone" value="{{ $employee->phone }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_house_no">House No:</label>
    <input type="text" id="edit_house_no" name="house_no" value="{{ $employee->house_no }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_street">Street:</label>
    <input type="text" id="edit_street" name="street" value="{{ $employee->street }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_baranggay">Baranggay:</label>
    <input type="text" id="edit_baranggay" name="baranggay" value="{{ $employee->baranggay }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_city">City:</label>
    <input type="text" id="edit_city" name="city" value="{{ $employee->city }}">
    <br>
    </div>
   
    <div class="group">
    <label for="edit_province">Province:</label>
    <input type="text" id="edit_province" name="province" value="{{ $employee->province }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_position">Position:</label>
    <input type="text" id="edit_position" name="position" value="{{ $employee->position }}">
    <br>
    </div>

    <div class="group">
    <label for="edit_payrate_per_hour">Pay Rate per Hour:</label>
    <input type="text" id="edit_payrate_per_hour" name="payrate_per_hour" value="{{ $employee->payrate_per_hour }}">
    <br>
    </div>

    <div class="group">
    <button type="submit">Update</button>
    </div>

</form>
</div>

<br>
<div class="show-documents">
<h2 style="text-align: center;">Documents</h2>
    @if($documents)
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td><img src="{{ asset('Images/EmployeeDocuments/') . '/' . $document->file_name }}" alt="Document Image" style="max-width: 100px"></td>
                        <td>{{ $document->document_type }}</td>
                        <td>
                            <form action="{{ route('delete-document', ['employee_id' => $employee->id, 'document_id' => $document->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button name="delete" type="submit" class="btn btn-danger" id= "documentdelete" onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No documents found.</p>
    @endif

<div>
    <br>
    <h2 style="text-align: center;">Upload New Documents</h2>
    <form action="{{ route('upload-documents', ['employee_id' => $employee->id]) }}" method="POST" enctype="multipart/form-data" id="upload-form">    
        @csrf
        <div id="document-inputs">
        <div class="group">
                    <label for="document_type">Document Type:</label>
                    <select name="document_type" id="document_type">
                        <option value="">Select ID Type</option>
                        <option value="SSS">SSS</option>
                        <option value="Pag-Ibig">Pag-Ibig</option>
                        <option value="PHILSys ID">PHILSys ID</option>
                        <option value="Passport">Passport</option>
                        <option value="UMID">UMID</option>
                        <option value="Driver's License">Driver's License</option>
                    </select>
                </div>
                @error('document_type')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="documentgroup">
                    <label for="files">Upload</label>
                    <input type="file" name="files[]" id="files" multiple>
                </div>
                @error('files')
                    <span class="error">{{ $message }}</span>
                @enderror
        </div>
        <button type="submit" id="upload_button">Submit</button>
    </form>
</div>
</div>


@else  

@endauth

    
</section>
</body>