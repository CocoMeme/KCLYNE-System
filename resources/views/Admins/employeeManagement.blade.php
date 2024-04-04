@extends('Layouts/header')

<body>
@if(session('success'))
        <div class="success-message-admin">
            {{ session('success') }}
        </div>
    @endif
    
    @auth('admin') 
    <section class="employee-management">

        {{-- EMPLOYEE CREATE --}}

        <div class="create-employee">
            <form class="form-create-product" action="{{ route('employee.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Employee Application</h2>
                <div class="group">
                    <label for="employee_position">Applying for:</label>
                    <select name="employee_position" required>
                        <option value="Cashier">Cashier</option>
                        <option value="Mechanic">Mechanic</option>
                    </select>
                    @error('employee_position')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                    <label for="employee_image">Employee Image</label>
                    <input id="employee_image" type="file" class="form-control @error('employee_image') is-invalid @enderror" name="employee_image" required>
                    @error('employee_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="group">
                    <label for="employee_first_name">First Name:</label>
                    <input name="employee_first_name" type="text" placeholder="Enter the first name" required>
                </div>
                @error('employee_first_name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_last_name">Last Name:</label>
                    <input name="employee_last_name" type="text" placeholder="Enter the last name" required>
                </div>
                @error('employee_last_name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_birth_date">Birth Date:</label>
                    <input name="employee_birth_date" type="date" placeholder="Enter the birth date" required>
                </div>
                @error('employee_birth_date')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_sex">Sex: </label>
                    <select name="employee_sex" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('employee_sex')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                    <label for="employee_phone">Phone #:</label>
                    <input name="employee_phone" type="text" placeholder="Enter the phone #" required>
                </div>
                @error('employee_phone')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_house_no">House #:</label>
                    <input name="employee_house_no" type="text" placeholder="Enter the house #" required>
                </div>
                @error('employee_house_no')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_street">Street: </label>
                    <input name="employee_street" type="text" placeholder="Enter the street" required>
                </div>
                @error('employee_street')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_baranggay">Baranggay: </label>
                    <input name="employee_baranggay" type="text" placeholder="Enter the baranggay" required>
                </div>
                @error('employee_baranggay')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_city">City: </label>
                    <input name="employee_city" type="text" placeholder="Enter the city" required>
                </div>
                @error('employee_city')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_province">Province: </label>
                    <input name="employee_province" type="text" placeholder="Enter the province" required>
                </div>
                @error('employee_province')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="employee_payrate_per_hour">Payrate/hr: </label>
                    <input name="employee_payrate_per_hour" type="text" placeholder="Enter the payrate/hr" required>
                </div>
                @error('employee_payrate_per_hour')
                    <span class="error">{{ $message }}</span>
                @enderror

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


                <div class="group">
                    <label for="files">Select Documents:</label>
                    <input type="file" name="files[]" id="files" multiple>
                </div>
                @error('files')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                <button type="submit">Create</button>
                </div>
            </form>
        </div>
        
        {{-- EMPLOYEE DISPLAY AND UPDATE --}}
<br>
<div class="show-employee">
    <h2 style="text-align: center;">Edit Employee Information</h2>
    <div class="employees">
        <table id="employees_table" class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Date</th>
                    <th>Sex</th>
                    <th>Phone</th>
                    <th>House No</th>
                    <th>Street</th>
                    <th>Baranggay</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Position</th>
                    <th>Pay Rate per Hour</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>
                        <img src="{{ asset('Images/Employees/') . '/' . $employee->employee_image }}" alt="Employee Image" class="employee-image">
                    </td>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->birth_date }}</td>
                    <td>{{ $employee->sex }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->house_no }}</td>
                    <td>{{ $employee->street }}</td>
                    <td>{{ $employee->baranggay }}</td>
                    <td>{{ $employee->city }}</td>
                    <td>{{ $employee->province }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->payrate_per_hour }}</td>
                    <td>
                        <button type="button" class="btn btn-primary edit-employee" data-id="{{ $employee->id }}">Edit</button>
                        <button type="button" class="btn btn-danger delete-employee" data-id="{{ $employee->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<script>

document.querySelectorAll('.edit-employee').forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.getAttribute('data-id');
            const editUrl = "{{ route('employee.edit', ':id') }}".replace(':id', employeeId);
            window.location.href = editUrl;
        });
    });

</script>

        @else  

        @endauth

            
    </section>
</body>