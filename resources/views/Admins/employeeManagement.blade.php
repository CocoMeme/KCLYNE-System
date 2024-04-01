@extends('Layouts/header')

<body>

    @auth('admin') 
    <section class="employee-management">

        {{-- EMPLOYEE CREATE --}}

        <div class="create-employee">
            <form class="form-create-employee" action="{{ route('employee.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Employee Application</h2>
                <div class="groupemployee">
                    <label for="employee_position">Position:</label>
                    <select name="employee_position" required>
                        <option value="Cashier">Cashier</option>
                        <option value="Mechanic">Mechanic</option>
                    </select>
                    @error('employee_position')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="groupemployee">
                    <label for="employee_first_name">First Name:</label>
                    <input name="employee_first_name" type="text" placeholder="Enter the first name" required>
                </div>
                @error('employee_first_name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_last_name">Last Name:</label>
                    <input name="employee_last_name" type="text" placeholder="Enter the last name" required>
                </div>
                @error('employee_last_name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_birth_date">Birth Date:</label>
                    <input name="employee_birth_date" type="date" placeholder="Enter the birth date" required>
                </div>
                @error('employee_birth_date')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_sex">Sex: </label>
                    <select name="employee_sex" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('employee_sex')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="groupemployee">
                    <label for="employee_phone">Phone #:</label>
                    <input name="employee_phone" type="text" placeholder="Enter the phone #" required>
                </div>
                @error('employee_phone')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_house_no">House #:</label>
                    <input name="employee_house_no" type="text" placeholder="Enter the house #" required>
                </div>
                @error('employee_house_no')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_street">Street: </label>
                    <input name="employee_street" type="text" placeholder="Enter the street" required>
                </div>
                @error('employee_street')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_baranggay">Baranggay: </label>
                    <input name="employee_baranggay" type="text" placeholder="Enter the baranggay" required>
                </div>
                @error('employee_baranggay')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_city">City: </label>
                    <input name="employee_city" type="text" placeholder="Enter the city" required>
                </div>
                @error('employee_city')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_province">Province: </label>
                    <input name="employee_province" type="text" placeholder="Enter the province" required>
                </div>
                @error('employee_province')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="employee_payrate_per_hour">Payrate/hr: </label>
                    <input name="employee_payrate_per_hour" type="text" placeholder="Enter the payrate/hr" required>
                </div>
                @error('employee_payrate_per_hour')
                    <span class="error">{{ $message }}</span>
                @enderror
        
                <div class="groupemployee">
                    <label for="employee_image">Employee Image</label>
                    <input id="employee_image" type="file" class="form-control @error('employee_image') is-invalid @enderror" name="employee_image" required>
                    @error('employee_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="groupemployee">
                    <label for="document_type">Document Type:</label>
                    <input type="text" name="document_type" id="document_type">
                </div>
                @error('document_type')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                    <label for="files">Select Documents:</label>
                    <input type="file" name="files[]" id="files" multiple>
                </div>
                @error('files')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="groupemployee">
                <button type="submit">Create</button>
                </div>
            </form>
        </div>
        
        {{-- EMPLOYEE DISPLAY AND UPDATE --}}
<br>
<div class="show-employee">
<form id="employee_form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h2 style="text-align: center;">Edit Employee Information</h2>
    <input type="hidden" id="selected_employee_id" name="selected_employee_id" value="">
    <div class="employees">
            <div class="groupemployee">
            <!-- <label for="user_image" id="upload_label">Upload Profile Picture<i class="fa-solid fa-pen-to-square"></i></label> -->
                <img id="edit_employee_image_preview" alt="Employee Image" style="max-width: 100px;"><br>
                <input id="edit_employee_image" type="file" class="form-control @error('edit_employee_image') is-invalid @enderror" name="edit_employee_image" style="align: center">
                    @error('edit_employee_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="groupemployee">
                <label for="employee_id">Select Employee:</label>
                <select id="employee_id" name="employee_id" class="form-control">
                <option value="...">...</option>
                @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="groupemployee">
                <label for="edit_first_name">First Name:</label>
                <input type="text" id="edit_first_name" name="first_name" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_last_name">Last Name:</label>
                <input type="text" id="edit_last_name" name="last_name" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_birth_date">Birth Date:</label>
                <input type="date" id="edit_birth_date" name="birth_date" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_sex">Sex:</label>
                <input type="text" id="edit_sex" name="sex" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_phone">Phone:</label>
                <input type="text" id="edit_phone" name="phone" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_house_no">House No:</label>
                <input type="text" id="edit_house_no" name="house_no" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_street">Street:</label>
                <input type="text" id="edit_street" name="street" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_baranggay">Baranggay:</label>
                <input type="text" id="edit_baranggay" name="baranggay" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_city">City:</label>
                <input type="text" id="edit_city" name="city" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_province">Province:</label>
                <input type="text" id="edit_province" name="province" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_position">Position:</label>
                <input type="text" id="edit_position" name="position" class="form-control">
            </div>
            <div class="groupemployee">
                <label for="edit_payrate_per_hour">Pay Rate per Hour:</label>
                <input type="text" id="edit_payrate_per_hour" name="payrate_per_hour" class="form-control">
            </div>

            <div id="employee_documents_container" style="display: none;" class="groupemployee">
            <label for="employee_documents">Employee Documents:</label>
            <table id="employee_documents_table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- JavaScript will populate this table body -->
                </tbody>
            </table>
        </div>

            <div class="groupemployee">
            <button type="submit" id="save_employee" class="btn btn-primary">Update</button>
            <button type="button" id="delete_employee" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>


<script>
document.getElementById('employee_id').addEventListener('change', function() {
    var employeeId = this.value;
    document.getElementById('selected_employee_id').value = employeeId;
    fetchEmployeeData(employeeId);
});

// Function to fetch employee data and update UI
function fetchEmployeeData(employeeId) {
    fetch('/fetch-employee-documents/' + employeeId)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var employee = data.employee;
            var documents = data.documents;

            // Update employee information fields
            document.getElementById('edit_first_name').value = employee.first_name;
            document.getElementById('edit_last_name').value = employee.last_name;
            document.getElementById('edit_birth_date').value = employee.birth_date;
            document.getElementById('edit_sex').value = employee.sex;
            document.getElementById('edit_phone').value = employee.phone;
            document.getElementById('edit_house_no').value = employee.house_no;
            document.getElementById('edit_street').value = employee.street;
            document.getElementById('edit_baranggay').value = employee.baranggay;
            document.getElementById('edit_city').value = employee.city;
            document.getElementById('edit_province').value = employee.province;
            document.getElementById('edit_position').value = employee.position;
            document.getElementById('edit_payrate_per_hour').value = employee.payrate_per_hour;
            
            // Update employee image preview
            var image = employee.employee_image;
            if (image) {
                document.getElementById('edit_employee_image_preview').src = "{{ asset('Images/Employees/') }}/" + image;
            } else {
                document.getElementById('edit_employee_image_preview').src = "";
            }

            // Update documents in UI
            updateDocumentsUI(documents);
        })
        .catch(error => console.error('Error fetching employee data:', error));
}

// Function to update documents in UI
function updateDocumentsUI(documents) {
    var tbody = document.querySelector('#employee_documents_table tbody');
    tbody.innerHTML = ''; // Clear the table body first
    
    documents.forEach(doc => {
        var tr = document.createElement('tr');
        
        // Image cell
        var tdImage = document.createElement('td');
        var img = document.createElement('img');
        img.src = "{{ asset('Images/EmployeeDocuments/') }}/" + doc.file_name;
        img.alt = doc.document_type;
        img.style.maxWidth = "100px";
        tdImage.appendChild(img);
        tr.appendChild(tdImage);

        // Document Type cell
        var tdDocumentType = document.createElement('td');
        tdDocumentType.textContent = doc.document_type;
        tr.appendChild(tdDocumentType);
        
        // Action cell
        var tdAction = document.createElement('td');
        
        var editButton = document.createElement('button');
        editButton.type = 'button';
        editButton.textContent = 'Edit';
        editButton.dataset.employeeId = doc.employee_id; // Add dataset for employee_id
        editButton.dataset.documentId = doc.id;
        editButton.classList.add('edit-document');
        tdAction.appendChild(editButton);
        
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Delete';
        deleteButton.dataset.employeeId = doc.employee_id; // Add dataset for employee_id
        deleteButton.dataset.documentId = doc.id;
        deleteButton.classList.add('delete-document');
        tdAction.appendChild(deleteButton);
        
        tr.appendChild(tdAction);
        
        tbody.appendChild(tr);
    });

    var employeeDocumentsContainer = document.getElementById('employee_documents_container');
    employeeDocumentsContainer.style.display = documents.length > 0 ? 'block' : 'none';
}

document.getElementById('save_employee').addEventListener('click', function(event) {
    event.preventDefault();
    
    var employeeId = document.getElementById('selected_employee_id').value;

    console.log('Employee ID:', employeeId);
    
    var formData = new FormData(document.getElementById('employee_form'));

    // Manually add the CSRF token to the FormData object
    formData.append('_token', '{{ csrf_token() }}');

    fetch('/update-employee/' + employeeId, {
        method: 'PUT',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to update employee');
        }
        return response.json();
    })
    .then(data => {
        console.log('Employee updated successfully:', data);
    })
    .catch(error => {
        console.error('Error updating employee:', error);
    });
});

</script>

        @else  

        @endauth

            
    </section>
</body>