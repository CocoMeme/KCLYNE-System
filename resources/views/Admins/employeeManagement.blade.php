@extends('Layouts/header')

<body>

    @auth('admin') 
    <section class="employee-management">

        {{-- EMPLOYEE CREATE --}}

        <div class="create-employee">
            <form class="form-create-employee" action="{{ route('employee.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Employee Application</h2>

                <div class="group">
                    <label for="employee_position">Applying For:</label>
                    <select name="employee_position" required>
                        <option value="Cashier">Cashier</option>
                        <option value="Mechanic">Mechanic</option>
                    </select>
                    @error('employee_position')
                        <span class="error">{{ $message }}</span>
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
                    <label for="Image">Employee Image:</label>
                    <input type="file" name="images[]" id="employee_image">
                    @error('employee_image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                <button type="submit">Create</button>
                </div>
            </form>
        </div>
        
        {{-- EMPLOYEE DISPLAY --}}

        <div class="show-employee">
            <h2 style="text-align: center;">All Employees</h2>
            <div class="employees">
                @foreach($employees as $employee)
                <div class="row">
                    @php
                    // Split the employee_image string into an array of image names
                    $images = explode('|', $employee->employee_image);
                    @endphp
                    @if(count($images) > 0)
                    <img src="{{ asset('Images/Employees/' . $images[0]) }}" alt="Employee Image" style="max-width: 100px;">
                    @endif
                    <h3>{{ $employee->employee_name }}</h3>
                </div>
                @endforeach
            </div>
        </div>
        

        @else  

        @endauth

            
    </section>
</body>